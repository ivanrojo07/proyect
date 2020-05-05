<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaIncidenteInstitucionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_incidente_institucion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoria_incidente_id');
            $table->unsignedBigInteger('institucion_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('categoria_incidente_id')->references('id')->on('categoria_incidentes');
            $table->foreign('institucion_id')->references('id')->on('institucions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoria_incidente_institucion');
    }
}
