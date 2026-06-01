<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('concurso_jurado_aspectos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concurso_id')->constrained('concursos')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('aspecto_id')->constrained('aspectos')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['concurso_id', 'user_id', 'aspecto_id'], 'concurso_jurado_aspecto_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('concurso_jurado_aspectos');
    }
};