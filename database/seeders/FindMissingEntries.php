<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FindMissingEntries extends Seeder
{
    public function run()
    {
        $htmlFile = base_path('import/dialect-table.html');
        $content = File::get($htmlFile);
        
        // Extrahiere alle Wörter aus der HTML-Datei
        $htmlWords = $this->extractAllWordsFromHtml($content);
        $importedWords = DB::table('dialect_expressions')->pluck('dialect_word')->toArray();
        
        $this->command->info("Gefunden in HTML: " . count($htmlWords) . " Wörter");
        $this->command->info("Importiert in DB: " . count($importedWords) . " Wörter");
        
        // Finde fehlende Wörter
        $missingWords = array_diff($htmlWords, $importedWords);
        
        $this->command->info("Fehlende Einträge: " . count($missingWords));
        
        if (count($missingWords) > 0) {
            $this->command->info("Fehlende Wörter:");
            foreach ($missingWords as $word) {
                $this->command->info("- '$word'");
            }
            
            // Zeige Kontext für fehlende Wörter
            $this->findContextForMissingWords($content, $missingWords);
        }
    }
    
    private function extractAllWordsFromHtml($html)
    {
        $words = [];
        $currentLetter = 'A';
        
        // Entferne Zeilenumbrüche
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
                    }
                    continue;
                }
                
                // Reinige die Zelleninhalte
                $dialectWord = trim(strip_tags($firstCell));
                
                if (!empty($dialectWord)) {
                    $words[] = $dialectWord;
                }
            }
        }
        
        return $words;
    }
    
    private function findContextForMissingWords($html, $missingWords)
    {
        $this->command->info("\nKontext für fehlende Wörter:");
        
        foreach ($missingWords as $missingWord) {
            // Finde die Zeile mit diesem Wort
            if (preg_match('/<tr>.*?' . preg_quote($missingWord, '/') . '.*?<\/tr>/', $html, $match)) {
                $this->command->info("Wort: '$missingWord'");
                $this->command->info("Kontext: " . substr(strip_tags($match[0]), 0, 100) . "...");
                $this->command->info("Raw HTML: " . substr($match[0], 0, 150) . "...\n");
            }
        }
    }
}