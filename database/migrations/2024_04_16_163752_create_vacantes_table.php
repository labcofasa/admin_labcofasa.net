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
            $table->timestamp('fecha_creacion');
            $table->timestamp('fecha_modificacion');
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
