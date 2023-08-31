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
        Schema::create('descripciones', function (Blueprint $table) {
            $table->id();
            $table->string('desc');
            $table->integer('precio');
            $table->integer('tipo')->default(1)->comment('  1 - Requiere tono
                                                            2 - No requiere tono, metales
                                                            3 - Ganchos (placas)');
            /*
                1 - Requiere tono
                2 - No requiere tono, metales
                3 - Ganchos (placas)
            */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descripciones');
    }
};
