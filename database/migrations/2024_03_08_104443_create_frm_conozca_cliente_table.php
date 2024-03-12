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
        Schema::create('frm_conozca_cliente', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->date('fecha_de_nacimiento');
            $table->string('nacionalidad');
            $table->string('profesion_u_oficicio');
            $table->string('tipo_de_documento');
            $table->string('numero_de_documento');
            $table->date('fecha_de_vencimiento');
            $table->string('registro_iva_nrc');
            $table->string('email');
            $table->string('telefono');
            $table->date('fecha_de_nombramiento');
            $table->text('direccion');
            $table->string('documento_identidad')->nullable();
            $table->string('documento_tarjeta_registro')->nullable();
            $table->string('documento_domicilio')->nullable();
            $table->unsignedBigInteger('pais_id')->nullable();
            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->unsignedBigInteger('municipio_id')->nullable();
            $table->unsignedBigInteger('giro_id');

            $table->timestamp('fecha_de_creacion')->nullable();
            $table->timestamp('fecha_de_modificacion')->nullable();

            $table->foreign('pais_id')->references('id')->on('paises');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->foreign('giro_id')->references('id')->on('giros');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frm_conozca_cliente');
    }
};