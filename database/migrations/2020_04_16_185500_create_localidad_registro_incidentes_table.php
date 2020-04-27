<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalidadRegistroIncidentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localidad_registro_incidentes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('localidad_id');
            $table->unsignedBigInteger('registro_incidente_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('localidad_id')->references('id')->on('localidads');
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
        Schema::dropIfExists('localidad_registro_incidentes');
    }
}
