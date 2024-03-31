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
        Schema::create('frm_conozca_cliente_archivos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_archivo');
            $table->unsignedBigInteger('frm_conozca_cliente_id');

            $table->foreign('frm_conozca_cliente_id')->references('id')->on('frm_conozca_cliente')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frm_conozca_cliente_archivos');
    }
};
