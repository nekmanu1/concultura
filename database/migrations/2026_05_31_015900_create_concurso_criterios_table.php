<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('concurso_criterios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concurso_id')->constrained('concursos')->cascadeOnDelete();
            $table->foreignId('criterio_id')->constrained('criterios')->cascadeOnDelete();
            $table->foreignId('aspecto_id')->constrained('aspectos')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['concurso_id', 'criterio_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('concurso_criterios');
    }
};