<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registro_incidente_id');

            $table->jsonb('datos_llamada')->nullable();
            $table->jsonb('tiempo_llamada')->nullable();
            $table->jsonb('tiempo_atencion')->nullable();
            $table->jsonb('descripcion_llamada')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('registro_incidente_id')->references('id')->on('registro_incidentes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dependencias');
    }
}
