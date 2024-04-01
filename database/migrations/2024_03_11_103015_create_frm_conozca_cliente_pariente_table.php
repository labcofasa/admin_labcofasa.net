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
        Schema::create('frm_conozca_cliente_pariente', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_pariente')->nullable();
            $table->string('parentesco')->nullable();
            $table->unsignedBigInteger('frm_conozca_cliente_id');
            $table->timestamp('fecha_de_creacion')->nullable();
            $table->timestamp('fecha_de_modificacion')->nullable();

            $table->foreign('frm_conozca_cliente_id')->references('id')->on('frm_conozca_cliente')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frm_conozca_cliente_pariente');
    }
};
