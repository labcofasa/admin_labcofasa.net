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
        Schema::create('clasificaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo');
            $table->string('nombre_tabla')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamp('updated_at')->nullable();
            $table->unsignedBigInteger('user_modified_id')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('user_deleted_id')->nullable();
            $table->timestamp('restored_at')->nullable();
            $table->unsignedBigInteger('user_restored_id')->nullable();

            $table->index('nombre');

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
        Schema::dropIfExists('clasificaciones');
    }
};
