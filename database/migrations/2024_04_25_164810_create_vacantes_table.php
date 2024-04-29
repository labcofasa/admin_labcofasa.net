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
        Schema::create('vacantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->text('requisitos');
            $table->text('beneficios');
            $table->date('fecha_vencimiento');
            $table->string('imagen')->nullable();
            $table->unsignedBigInteger('id_empresa')->nullable();
            $table->unsignedBigInteger('id_tipo_contratacion')->nullable();
            $table->unsignedBigInteger('id_modalidad')->nullable();
            $table->unsignedBigInteger('id_pais')->nullable();
            $table->unsignedBigInteger('id_departamento')->nullable();
            $table->unsignedBigInteger('id_municipio')->nullable();

            $table->timestamp('fecha_creacion');
            $table->timestamp('fecha_modificacion');

            $table->foreign('id_empresa')->references('id')->on('empresas');
            $table->foreign('id_tipo_contratacion')->references('id')->on('tipo_contratacion');
            $table->foreign('id_modalidad')->references('id')->on('modalidades');
            $table->foreign('id_pais')->references('id')->on('paises');
            $table->foreign('id_departamento')->references('id')->on('departamentos');
            $table->foreign('id_municipio')->references('id')->on('municipios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacantes');
    }
};
