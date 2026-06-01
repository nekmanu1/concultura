<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concurso_id')->constrained('concursos')->cascadeOnDelete();
            $table->foreignId('participante_id')->constrained('participantes')->cascadeOnDelete();
            $table->foreignId('jurado_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('criterio_id')->constrained('criterios')->cascadeOnDelete();
            $table->foreignId('aspecto_id')->constrained('aspectos')->cascadeOnDelete();
            $table->decimal('puntaje', 8, 2)->default(0);
            $table->text('observacion')->nullable();
            $table->timestamps();

            $table->unique(
                ['concurso_id', 'participante_id', 'jurado_id', 'criterio_id'],
                'evaluacion_unica'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluacions');
    }
};