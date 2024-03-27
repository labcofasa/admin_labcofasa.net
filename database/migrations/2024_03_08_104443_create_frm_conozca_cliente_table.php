<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */

    // php artisan migrate:rollback --step=7


    public function up(): void
    {
        Schema::create('frm_conozca_cliente', function (Blueprint $table) {
            $table->id();
            $table->string('tipo')->nullable();
            $table->string('tipo_persona')->nullable();
            $table->boolean('estado')->default(false);
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->date('fecha_de_nacimiento')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->string('profesion_u_oficio')->nullable();
            $table->string('tipo_de_documento')->nullable();
            $table->string('numero_de_documento')->nullable();
            $table->date('fecha_de_vencimiento')->nullable();
            $table->string('registro_iva_nrc')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->date('fecha_de_nombramiento')->nullable();
            $table->text('direccion')->nullable();
            $table->text('cargo_publico')->nullable();
            $table->text('familiar_publico')->nullable();
            $table->text('direccion_ip')->nullable();
            $table->string('documento_identidad')->nullable();
            $table->string('documento_tarjeta_registro')->nullable();
            $table->string('documento_domicilio')->nullable();
            $table->string('formulario_firmado')->nullable();
            $table->unsignedBigInteger('pais_id')->nullable();
            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->unsignedBigInteger('municipio_id')->nullable();
            $table->unsignedBigInteger('giro_id')->nullable();

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
