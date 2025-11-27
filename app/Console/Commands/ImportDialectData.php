<?php

namespace App\Console\Commands;

use App\Models\DialectExpression;
use Illuminate\Console\Command;

class ImportDialectData extends Command
{
    protected $signature = 'import:dialect {--file=}';
    protected $description = 'Import dialect data from HTML table';

    public function handle()
    {
        $filePath = $this->option('file') ?: base_path('import/dialect-table.html');
        
        if (!file_exists($filePath)) {
            $this->error("Datei nicht gefunden: {$filePath}");
            return 1;
        }

        $html = file_get_contents($filePath);
        $data = $this->parseHtmlTable($html);
        
        $this->info("Gefunden: " . count($data) . " Einträge");
        
        $imported = 0;
        $skipped = 0;
        
        foreach ($data as $entry) {
            if (empty($entry['dialect']) || empty($entry['translation'])) {
                $skipped++;
                continue;
            }
            
            // Prüfen ob Eintrag bereits existiert
            $exists = DialectExpression::where('dialect_word', $entry['dialect'])
                                     ->where('german_translation', $entry['translation'])
                                     ->exists();
            
            if (!$exists) {
                $letter = $this->getFirstLetter($entry['dialect']);
                
                DialectExpression::create([
                    'dialect_word' => trim($entry['dialect']),
                    'german_translation' => trim($entry['translation']),
                    'letter' => $letter,
                ]);
                $imported++;
            } else {
                $skipped++;
            }
        }
        
        $this->info("Import abgeschlossen!");
        $this->info("Importiert: {$imported} neue Einträge");
        $this->info("Übersprungen: {$skipped} vorhandene Einträge");
        
        return 0;
    }
    
    private function getFirstLetter(string $word): string
    {
        $firstChar = substr(trim($word), 0, 1);
        $letter = strtoupper($firstChar);
        
        // Umlaute zu Basis-Buchstaben konvertieren
        $umlautMap = [
            'Ä' => 'A',
            'Ö' => 'O', 
            'Ü' => 'U',
        ];
        
        $letter = $umlautMap[$letter] ?? $letter;
        
        // Falls immer noch kein A-Z, dann 'A' verwenden
        if (!preg_match('/[A-Z]/', $letter)) {
            return 'A';
        }
        
        return $letter;
    }
    
    private function parseHtmlTable(string $html): array
    {
        $data = [];
        
        preg_match_all('/<tr>\s*<td[^>]*>\s*(.*?)\s*<\/td>\s*<td[^>]*>\s*(.*?)\s*<\/td>\s*<\/tr>/s', $html, $matches, PREG_SET_ORDER);
        
        foreach ($matches as $match) {
            $dialect = strip_tags($match[1]);
            $translation = strip_tags($match[2]);
            
            $dialect = str_replace('&nbsp;', ' ', $dialect);
            $translation = str_replace('&nbsp;', ' ', $translation);
            
            $dialect = preg_replace('/\s+/', ' ', $dialect);
            $translation = preg_replace('/\s+/', ' ', $translation);
            
            // Buchstaben-Header überspringen
            if (preg_match('/^[A-Za-z]$/', trim($dialect)) || empty(trim($dialect))) {
                continue;
            }
            
            $data[] = [
                'dialect' => trim($dialect),
                'translation' => trim($translation),
            ];
        }
        
        return $data;
    }
}