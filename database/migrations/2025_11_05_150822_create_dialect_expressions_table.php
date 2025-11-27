<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('dialect_expressions', function (Blueprint $table) {
        $table->id();
        $table->string('dialect_word');           // Dialekt-Ausdruck
        $table->string('german_translation');     // Hochdeutsche Übersetzung
        $table->text('example_sentence')->nullable(); // Beispielsatz
        $table->string('region')->nullable();     // Region in Hessen
        $table->string('letter');                 // Anfangsbuchstabe (A, B, C...)
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dialect_expressions');
    }
};
