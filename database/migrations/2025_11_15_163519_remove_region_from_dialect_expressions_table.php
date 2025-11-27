<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('dialect_expressions', function (Blueprint $table) {
            // Nur entfernen wenn die Spalte existiert
            if (Schema::hasColumn('dialect_expressions', 'region')) {
                $table->dropColumn('region');
            }
        });
    }

    public function down()
    {
        Schema::table('dialect_expressions', function (Blueprint $table) {
            $table->string('region')->nullable();
        });
    }
};