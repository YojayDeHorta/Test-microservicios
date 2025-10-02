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
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Columna 'id' autoincremental y clave primaria
            $table->unsignedBigInteger('user_id')->index(); // Almacena el ID del usuario. Lo indexamos para búsquedas rápidas.
            $table->string('title'); // Columna para el título del post
            $table->text('content'); // Columna para el contenido, tipo TEXT para textos largos
            $table->timestamps(); // Columnas 'created_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};