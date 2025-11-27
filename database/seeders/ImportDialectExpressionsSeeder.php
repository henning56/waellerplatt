<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class ImportDialectExpressionsSeeder extends Seeder
{
    public function run()
    {
        // Temporäre MySQL-Konfiguration
        Config::set('database.connections.temp-mysql', [
            'driver' => 'mysql',
            'host' => 'mysql',
            'port' => 3306,
            'database' => 'hermann',
            'username' => 'root',
            'password' => 'password',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ]);

        try {
            $mysqlData = DB::connection('temp-mysql')->table('dialect_expressions')->get();
            $this->command->info('Gefunden: ' . $mysqlData->count() . ' Einträge in MySQL');
            
            $imported = 0;
            foreach ($mysqlData as $data) {
                DB::table('dialect_expressions')->insert([
                    'id' => $data->id,
                    'dialect_word' => $data->dialect_word,
                    'german_translation' => $data->german_translation,
                    'example_sentence' => $data->example_sentence,
                    'letter' => $data->letter,
                    'created_at' => $data->created_at,
                    'updated_at' => $data->updated_at,
                ]);
                $imported++;
            }
            
            $this->command->info("✅ Import abgeschlossen: $imported Einträge importiert");
            
        } catch (\Exception $e) {
            $this->command->error('Fehler beim Import: ' . $e->getMessage());
        }
    }
}