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
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();
            $table->uuid('Codigo');
            $table->dateTime('Fecha')->nullable();
            $table->text('Comentarios')->nullable();
            $table->timestamps();//FechaCreacion y FechaActualziacion
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacciones');
    }
};
