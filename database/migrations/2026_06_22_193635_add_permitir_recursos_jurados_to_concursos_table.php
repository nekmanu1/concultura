<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('concursos', function (Blueprint $table) {
        $table->boolean('permitir_recursos_jurados')->default(false)->after('estado');
    });
}

public function down(): void
{
    Schema::table('concursos', function (Blueprint $table) {
        $table->dropColumn('permitir_recursos_jurados');
    });
}
};

