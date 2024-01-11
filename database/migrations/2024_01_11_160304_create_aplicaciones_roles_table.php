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
        Schema::create('aplicaciones_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aplicacion_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();

            $table->foreign('aplicacion_id')->references('id')->on('aplicaciones')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aplicaciones_roles');
    }
};
