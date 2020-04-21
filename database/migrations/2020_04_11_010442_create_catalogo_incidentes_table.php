<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogoIncidentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogo_incidentes', function (Blueprint $table) {
            $table->id();
            $table->string('clave');
            $table->string('nombre');
            $table->unsignedBigInteger('prioridad_id');
            $table->unsignedBigInteger('subcategoria_id');
            $table->foreign('prioridad_id')->references('id')->on('prioridads');
            $table->foreign('subcategoria_id')->references('id')->on('subcategoria_incidentes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogo_incidentes');
    }
}
