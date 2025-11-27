<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FullImportSeeder extends Seeder
{
    public function run()
    {
        // Tabelle leeren
        DB::table('dialect_expressions')->delete();
        DB::statement('DELETE FROM sqlite_sequence WHERE name = "dialect_expressions"');
        
        $this->command->info('Starte Import aller Daten...');
        
        $backupFile = base_path('dialect_backup.sql');
        
        if (!File::exists($backupFile)) {
            $this->command->error('Backup-Datei nicht gefunden: ' . $backupFile);
            return;
        }
        
        $content = File::get($backupFile);
        $imported = $this->parseAndImportSQL($content);
        
        $this->command->info("✅ Kompletter Import abgeschlossen: $imported Einträge importiert");
    }
    
    private function parseAndImportSQL($sqlContent)
    {
        $imported = 0;
        
        // INSERT-Zeilen finden - angepasst für MySQL-Export-Format
        preg_match_all("/INSERT INTO `dialect_expressions` VALUES (\(.*?\));/s", $sqlContent, $matches);
        
        if (empty($matches[1])) {
            $this->command->error('Keine INSERT-Befehle gefunden!');
            return 0;
        }
        
        $this->command->info("Gefunden: " . count($matches[1]) . " INSERT-Befehle");
        
        foreach ($matches[1] as $rowGroup) {
            // Ein INSERT-Befehl kann mehrere Zeilen enthalten
            $rows = explode('),(', $rowGroup);
            
            foreach ($rows as $row) {
                $row = trim($row, '()');
                $values = $this->parseSQLValues($row);
                
                if (count($values) >= 7) { // Mindestens 7 Werte erwartet
                    try {
                        DB::table('dialect_expressions')->insert([
                            'id' => $this->cleanValue($values[0]),
                            'dialect_word' => $this->cleanValue($values[1]),
                            'german_translation' => $this->cleanValue($values[2]),
                            'example_sentence' => $this->cleanValue($values[3]),
                            // 'region' => $values[4] - WIRD AUSGELASSEN
                            'letter' => $this->cleanValue($values[5]),
                            'created_at' => $this->cleanValue($values[6]),
                            'updated_at' => $this->cleanValue($values[7] ?? $values[6]), // Falls updated_at fehlt
                        ]);
                        $imported++;
                    } catch (\Exception $e) {
                        $this->command->warn("Fehler beim Import von ID {$values[0]}: " . $e->getMessage());
                    }
                }
                
                // Fortschritt anzeigen
                if ($imported % 100 === 0) {
                    $this->command->info("$imported Einträge importiert...");
                }
            }
        }
        
        return $imported;
    }
    
    private function parseSQLValues($row)
    {
        $values = [];
        $current = '';
        $inString = false;
        $escapeNext = false;
        
        for ($i = 0; $i < strlen($row); $i++) {
            $char = $row[$i];
            
            if ($escapeNext) {
                $current .= $char;
                $escapeNext = false;
                continue;
            }
            
            if ($char === '\\') {
                $escapeNext = true;
                continue;
            }
            
            if ($char === "'") {
                $inString = !$inString;
                continue;
            }
            
            if ($char === ',' && !$inString) {
                $values[] = $current;
                $current = '';
                continue;
            }
            
            $current .= $char;
        }
        
        if ($current !== '') {
            $values[] = $current;
        }
        
        return $values;
    }
    
    private function cleanValue($value)
    {
        // Entferne umgebende Quotes und escaped Zeichen
        $value = trim($value, "'");
        $value = str_replace("\\'", "'", $value);
        $value = str_replace('\\"', '"', $value);
        $value = str_replace('\\\\', '\\', $value);
        
        // Konvertiere MySQL NULL zu PHP null
        if ($value === 'NULL') {
            return null;
        }
        
        return $value;
    }
}