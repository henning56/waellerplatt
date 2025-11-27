<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportOriginalDataSeeder extends Seeder
{
    public function run()
    {
        // Zuerst die Tabelle leeren
        DB::table('dialect_expressions')->delete();
        
        // SQLite Sequence zurücksetzen
        DB::statement('DELETE FROM sqlite_sequence WHERE name = "dialect_expressions"');
        
        $this->command->info('Importiere Originaldaten...');
        
        // Manuell die Daten einfügen (angepasst an deine Spalten)
        $data = [
            // Hier werden wir die Daten aus der SQL-Datei einfügen
        ];
        
        // Temporär: Einige Beispieldaten aus der Backup-Datei
        $imported = $this->importFromBackup();
        
        $this->command->info("✅ Import abgeschlossen: $imported Einträge importiert");
    }
    
    private function importFromBackup()
    {
        // Einige Beispieldaten aus der SQL-Datei manuell einfügen
        // In der Praxis würdest du hier die SQL-Datei parsen
        $sampleData = [
            [
                'dialect_word' => 'Aap',
                'german_translation' => 'Affe',
                'example_sentence' => 'Du bisch wie en Aap.',
                'letter' => 'A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dialect_word' => 'Babbel',
                'german_translation' => 'Mund',
                'example_sentence' => 'Halt dei Babbel!',
                'letter' => 'B', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dialect_word' => 'Gugg',
                'german_translation' => 'Schau',
                'example_sentence' => 'Gugg mol do!',
                'letter' => 'G',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        
        foreach ($sampleData as $data) {
            DB::table('dialect_expressions')->insert($data);
        }
        
        return count($sampleData);
    }
}