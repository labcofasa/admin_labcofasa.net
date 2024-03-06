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
        Schema::create('forms_conozca_cliente_accionistas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('nacionalidad');
            $table->string('numero_identidad');
            $table->string('porcentaje_participacion');
            $table->unsignedBigInteger('forms_conozca_cliente_id');
            $table->timestamps();

            $table->foreign('forms_conozca_cliente_id')->references('id')->on('forms_conozca_cliente')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms_conozca_cliente_accionistas');
    }
};
