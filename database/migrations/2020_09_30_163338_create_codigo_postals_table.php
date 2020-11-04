<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodigoPostalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigo_postals', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->string('asentamiento')->nullable();
            $table->string('tipo_asentamiento')->nullable();
            $table->string('municipio')->nullable();
            $table->string('estado')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('codigo_estado')->nullable();
            $table->string('codigo_oficina')->nullable();
            $table->string('codigo_postal_c')->nullable();
            $table->string('codigo_tipo_asentamiento')->nullable();
            $table->string('codigo_municipio')->nullable();
            $table->string('id_asentamiento_cpcons')->nullable();
            $table->string('zona')->nullable();
            $table->string('clave_ciudad')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codigo_postals');
    }
}
