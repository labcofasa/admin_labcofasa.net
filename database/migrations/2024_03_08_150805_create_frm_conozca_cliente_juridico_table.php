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
        Schema::create('frm_conozca_cliente_juridico', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_comercial_juridico')->nullable();
            $table->string('nacionalidad_juridico')->nullable();
            $table->string('numero_de_nit_juridico')->nullable();
            $table->date('fecha_de_constitucion_juridico')->nullable();
            $table->string('registro_nrc_juridico')->nullable();
            $table->string('telefono_juridico')->nullable();
            $table->string('sitio_web_juridico')->nullable();
            $table->string('numero_de_fax_juridico')->nullable();
            $table->text('direccion_juridico')->nullable();
            $table->string('monto_proyectado')->nullable();
            $table->string('documento_escritura')->nullable();
            $table->string('documento_acuerdo')->nullable();
            $table->string('documento_nit')->nullable();
            $table->string('documento_credencial')->nullable();
            $table->string('documento_identificacion_representante')->nullable();
            $table->string('documento_matricula')->nullable();
            $table->string('documento_domicilio_juridico')->nullable();
            $table->unsignedBigInteger('frm_conozca_cliente_id')->nullable();
            $table->unsignedBigInteger('clasificacion_id')->nullable();
            $table->unsignedBigInteger('giro_id')->nullable();
            $table->unsignedBigInteger('pais_id')->nullable();
            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->unsignedBigInteger('municipio_id')->nullable();

            $table->timestamp('fecha_de_creacion')->nullable();
            $table->timestamp('fecha_de_modificacion')->nullable();

            $table->foreign('frm_conozca_cliente_id')->references('id')->on('frm_conozca_cliente');
            $table->foreign('clasificacion_id')->references('id')->on('clasificaciones');
            $table->foreign('giro_id')->references('id')->on('giros');
            $table->foreign('pais_id')->references('id')->on('paises');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('municipio_id')->references('id')->on('municipios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frm_conozca_cliente_juridico');
    }
};