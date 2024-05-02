<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_candidato');
            $table->unsignedBigInteger('id_vacante')->nullable();

            $table->timestamp('fecha_creacion');
            $table->timestamp('fecha_modificacion');

            $table->foreign('id_vacante')->references('id')->on('vacantes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidatos');
    }
};
