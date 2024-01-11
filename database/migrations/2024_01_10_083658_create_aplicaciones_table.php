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
        Schema::create('aplicaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_aplicacion');
            $table->string('imagen_aplicacion')->nullable();
            $table->string('enlace_aplicacion');
            $table->string('nombre_tabla')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamp('updated_at')->nullable();
            $table->unsignedBigInteger('user_modified_id')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('user_deleted_id')->nullable();
            $table->timestamp('restored_at')->nullable();
            $table->unsignedBigInteger('user_restored_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_modified_id')->references('id')->on('users');
            $table->foreign('user_deleted_id')->references('id')->on('users');
            $table->foreign('user_restored_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aplicaciones');
    }
};
