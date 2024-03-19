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
        Schema::create('frm_conozca_cliente_politico', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_politico')->nullable();
            $table->string('nombre_cargo_politico')->nullable();
            $table->date('fecha_desde_politico')->nullable();
            $table->date('fecha_hasta_politico')->nullable();
            $table->string('nombre_cliente_politico')->nullable();
            $table->string('porcentaje_participacion_politico')->nullable();
            $table->string('fuente_ingreso')->nullable();
            $table->string('monto_mensual')->nullable();
            $table->unsignedBigInteger('frm_conozca_cliente_id');
            $table->unsignedBigInteger('pais_id')->nullable();
            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->unsignedBigInteger('municipio_id')->nullable();

            $table->timestamp('fecha_de_creacion')->nullable();
            $table->timestamp('fecha_de_modificacion')->nullable();

            $table->foreign('frm_conozca_cliente_id')->references('id')->on('frm_conozca_cliente');
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
        Schema::dropIfExists('frm_conozca_cliente_politico');
    }
};