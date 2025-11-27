<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class OriginalDataImporter extends Seeder
{
    public function run()
    {
        // Tabelle leeren
        DB::table('dialect_expressions')->delete();
        DB::statement('DELETE FROM sqlite_sequence WHERE name = "dialect_expressions"');
        
        $this->command->info('Importiere Originaldaten aus HTML...');
        
        // Angepasster Pfad zu deiner Datei
        $htmlFile = base_path('import/dialect-table.html');
        
        if (!File::exists($htmlFile)) {
            $this->command->error('HTML-Datei nicht gefunden: ' . $htmlFile);
            $this->command->info('Verfügbare Dateien in import/:');
            $files = glob(base_path('import/*'));
            foreach ($files as $file) {
                $this->command->info('- ' . basename($file));
            }
            return;
        }
        
        $content = File::get($htmlFile);
        $imported = $this->parseHtmlTable($content);
        
        $this->command->info("✅ Import abgeschlossen: $imported Einträge importiert");
    }
    
    private function parseHtmlTable($html)
    {
        $imported = 0;
        $currentLetter = 'A';
        
        // Entferne Zeilenumbrüche für bessere Regex-Verarbeitung
        $html = preg_replace('/\s+/', ' ', $html);
        
        // Finde alle Tabellenzeilen
        preg_match_all('/<tr>(.*?)<\/tr>/', $html, $rowMatches);
        
        foreach ($rowMatches[1] as $row) {
            // Finde alle Zellen in dieser Zeile
            preg_match_all('/<td[^>]*>(.*?)<\/td>/', $row, $cellMatches);
            
            if (count($cellMatches[1]) >= 2) {
                $firstCell = trim($cellMatches[1][0]);
                $secondCell = trim($cellMatches[1][1]);
                
                // Buchstaben-Überschrift erkennen
                if (strpos($firstCell, '<a name="') !== false) {
                    preg_match('/<a name="([^"]+)"/', $firstCell, $letterMatch);
                    if ($letterMatch) {
                        $currentLetter = $letterMatch[1];
                        $this->command->info("Gefunden: Buchstabe $currentLetter");
                    }
                    continue; // Überschrift überspringen
                }
                
                // Reinige die Zelleninhalte
                $dialectWord = trim(strip_tags($firstCell));
                $germanTranslation = trim(strip_tags($secondCell));
                
                // Überspringe leere Zeilen oder Überschriften
                if (empty($dialectWord) || empty($germanTranslation)) {
                    continue;
                }
                
                // Bestimme den Buchstaben
                $firstChar = strtoupper(mb_substr($dialectWord, 0, 1));
                
                // Buchstabe bestimmen
                if (ctype_alpha($firstChar)) {
                    $letter = $firstChar;
                } else {
                    $letter = $currentLetter;
                }
                
                // Umlaute behandeln
                $umlautMap = [
                    'Ä' => 'A', 'Ö' => 'O', 'Ü' => 'U',
                    'ä' => 'A', 'ö' => 'O', 'ü' => 'U'
                ];
                
                if (isset($umlautMap[$firstChar])) {
                    $letter = $umlautMap[$firstChar];
                }
                
                try {
                    DB::table('dialect_expressions')->insert([
                        'dialect_word' => $dialectWord,
                        'german_translation' => $germanTranslation,
                        'example_sentence' => null,
                        'letter' => $letter,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $imported++;
                    
                    if ($imported % 20 === 0) {
                        $this->command->info("$imported Einträge importiert...");
                    }
                    
                } catch (\Exception $e) {
                    $this->command->warn("Fehler bei '$dialectWord': " . $e->getMessage());
                }
            }
        }
        
        return $imported;
    }
}