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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('nombre_tabla')->nullable();
            $table->timestamp('created_at');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamp('updated_at');
            $table->unsignedBigInteger('user_modified_id')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('user_deleted_id')->nullable();
            $table->timestamp('restored_at')->nullable();
            $table->unsignedBigInteger('user_restored_id')->nullable();
            $table->rememberToken();

            $table->index('name');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
