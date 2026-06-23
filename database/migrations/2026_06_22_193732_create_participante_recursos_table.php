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
    Schema::create('participante_recursos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('participante_id')->constrained()->cascadeOnDelete();
        $table->string('titulo')->nullable();
        $table->string('url');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('participante_recursos');
}
};
