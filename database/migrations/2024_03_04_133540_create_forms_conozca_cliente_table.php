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
        Schema::create('forms_conozca_cliente', function (Blueprint $table) {
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
            $table->string('nombre_comercial');
            $table->string('nacionalidad_persona_juridica');
            $table->string('numero_de_nit');
            $table->date('fecha_de_constitucion');
            $table->string('registro_nrc_persona_juridica');
            $table->string('telefono_persona_juridica');
            $table->string('sitio_web');
            $table->string('numero_de_fax');
            $table->text('direccion_persona_juridica');
            $table->unsignedBigInteger('clasificacion_id');
            $table->unsignedBigInteger('giro_id');
            $table->unsignedBigInteger('giro_persona_juridica_id');
            $table->unsignedBigInteger('pais_id')->nullable();
            $table->unsignedBigInteger('pais_persona_juridica_id')->nullable();
            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->unsignedBigInteger('departamento_persona_juridica_id')->nullable();
            $table->unsignedBigInteger('municipio_id')->nullable();
            $table->unsignedBigInteger('municipio_persona_juridica_id')->nullable();
            $table->timestamp('fecha_de_creacion')->nullable();
            $table->timestamp('fecha_de_modificacion')->nullable();

            $table->foreign('clasificacion_id')->references('id')->on('clasificaciones');
            $table->foreign('giro_id')->references('id')->on('giros');
            $table->foreign('giro_persona_juridica_id')->references('id')->on('giros');
            $table->foreign('pais_id')->references('id')->on('paises');
            $table->foreign('pais_persona_juridica_id')->references('id')->on('paises');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('departamento_persona_juridica_id')->references('id')->on('departamentos');
            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->foreign('municipio_persona_juridica_id')->references('id')->on('municipios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms_conozca_cliente');
    }
};
