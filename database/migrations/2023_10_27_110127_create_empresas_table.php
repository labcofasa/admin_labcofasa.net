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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('direccion');
            $table->string('imagen')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('web')->nullable();
            $table->date('fundacion')->nullable();
            $table->string('registro_nit')->nullable();
            $table->string('registro_iva')->nullable();
            $table->string('nombre_dnm')->nullable();
            $table->string('registro_dnm')->nullable();
            $table->string('nombre_tabla')->nullable();
            $table->text('mision')->nullable();
            $table->text('vision')->nullable();
            $table->text('calidad')->nullable();

            $table->unsignedBigInteger('giro_id');
            $table->unsignedBigInteger('entidad_id');
            $table->unsignedBigInteger('clasificacion_id');
            $table->unsignedBigInteger('pais_id');
            $table->unsignedBigInteger('departamento_id');
            $table->unsignedBigInteger('municipio_id');

            $table->timestamp('created_at')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->timestamp('updated_at')->nullable();
            $table->unsignedBigInteger('user_modified_id')->nullable();

            $table->softDeletes();
            $table->unsignedBigInteger('user_deleted_id')->nullable();

            $table->timestamp('restored_at')->nullable();
            $table->unsignedBigInteger('user_restored_id')->nullable();

            $table->index('nombre');

            $table->foreign('giro_id')->references('id')->on('giros');
            $table->foreign('entidad_id')->references('id')->on('entidades');
            $table->foreign('clasificacion_id')->references('id')->on('clasificaciones');
            $table->foreign('pais_id')->references('id')->on('paises');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('municipio_id')->references('id')->on('municipios');
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
        Schema::dropIfExists('empresas');
    }
};
