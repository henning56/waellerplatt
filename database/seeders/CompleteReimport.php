<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CompleteReimport extends Seeder
{
    public function run()
    {
        // Tabelle komplett leeren
        DB::table('dialect_expressions')->delete();
        DB::statement('DELETE FROM sqlite_sequence WHERE name = "dialect_expressions"');
        
        $htmlFile = base_path('import/dialect-table.html');
        $content = File::get($htmlFile);
        
        $this->command->info('Starte komplett neuen Import...');
        
        $imported = $this->parseAllEntries($content);
        
        $this->command->info("✅ Kompletter Import abgeschlossen: $imported Einträge");
    }
    
    private function parseAllEntries($html)
    {
        $imported = 0;
        $currentLetter = 'A';
        
        $html = preg_replace('/\s+/', ' ', $html);
        preg_match_all('/<tr>(.*?)<\/tr>/', $html, $rowMatches);
        
        foreach ($rowMatches[1] as $row) {
            preg_match_all('/<td[^>]*>(.*?)<\/td>/', $row, $cellMatches);
            
            if (count($cellMatches[1]) >= 2) {
                $firstCell = trim($cellMatches[1][0]);
                $secondCell = trim($cellMatches[1][1]);
                
                // Buchstaben-Überschrift erkennen
                if (strpos($firstCell, '<a name="') !== false) {
                    preg_match('/<a name="([^"]+)"/', $firstCell, $letterMatch);
                    if ($letterMatch) {
                        $currentLetter = $letterMatch[1];
                    }
                    // Überschrift nicht überspringen, sondern als Dateneintrag behandeln
                }
                
                // Reinige die Zelleninhalte
                $dialectWord = $this->cleanContent($firstCell);
                $germanTranslation = $this->cleanContent($secondCell);
                
                if (empty($dialectWord) || empty($germanTranslation)) {
                    continue;
                }
                
                // Bestimme Buchstaben
                $firstChar = strtoupper(mb_substr($dialectWord, 0, 1));
                $letter = ctype_alpha($firstChar) ? $firstChar : $currentLetter;
                
                // Umlaute behandeln
                $umlautMap = ['Ä' => 'A', 'Ö' => 'O', 'Ü' => 'U'];
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
                    
                } catch (\Exception $e) {
                    // Ignoriere Duplikate
                }
            }
        }
        
        return $imported;
    }
    
    private function cleanContent($content)
    {
        // Entferne alle HTML-Tags
        $content = strip_tags($content);
        // Entferne überflüssige Leerzeichen
        $content = preg_replace('/\s+/', ' ', $content);
        // Trimmen
        $content = trim($content);
        
        return $content;
    }
}