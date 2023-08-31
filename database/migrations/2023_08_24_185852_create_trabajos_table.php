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
        Schema::create('trabajos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_descripcion');
            $table->foreign('id_descripcion')
                  ->references('id')->on('descripciones')->onDelete('cascade');
            $table->unsignedBigInteger('id_doctor');
            $table->foreign('id_doctor')
                  ->references('id')->on('doctores')->onDelete('cascade');
            $table->string('paciente');
            $table->string('id_tono', 10)->nullable();
            $table->foreign('id_tono')
                  ->references('id')->on('tonos')->onDelete('cascade');
            $table->unsignedInteger('folio');
            $table->date('fecha_recepcion');
            $table->date('fecha_entrega')->nullable();
            $table->boolean('urgente');
            $table->integer('total');
            $table->unsignedInteger('ganchos_bola')->nullable();
            $table->unsignedInteger('ganchos_wipla')->nullable();
            $table->unsignedInteger('ganchos_vaciado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajos');
    }
};
