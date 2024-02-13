<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // $table->foreign('transaccion_id')->references('id')->on('transacciones');
    // $table->foreign('producto_id')->references('id')->on('productos');
    // $table->foreign('almacen_id')->references('id')->on('almacenes');
    public function up(): void
    {
        Schema::create('detalle_transacciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaccion_id')->constrained('transacciones');
            $table->foreignId('producto_id')->constrained('productos');
            $table->foreignId('almacen_id')->constrained('almacenes');
            $table->integer('Cantidad');
            $table->decimal('Costo',  8,  2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_transacciones');
    }
};
