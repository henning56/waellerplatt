<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        // Zuerst prüfen ob Tabelle existiert
        if (!\Illuminate\Support\Facades\Schema::hasTable('dialect_expressions')) {
            $this->command->error('Tabelle dialect_expressions existiert nicht!');
            return;
        }

        DB::table('dialect_expressions')->insert([
            [
                'dialect_word' => 'Testwort',
                'german_translation' => 'Testübersetzung',
                'example_sentence' => 'Das ist ein Beispielsatz.',
                'letter' => 'T',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        
        $count = DB::table('dialect_expressions')->count();
        $this->command->info("✅ Testdaten eingefügt. Gesamt Einträge: $count");
    }
}