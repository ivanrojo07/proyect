<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCatalogoIdToCatalogoIncidentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalogo_incidentes', function (Blueprint $table) {
            //
            //
            $table->unsignedBigInteger('catalogo_id')->nullable();
            $table->foreign('catalogo_id')->references('id')->on('catalogos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catalogo_incidentes', function (Blueprint $table) {
            //
            $table->dropForeign(['catalogo_id']);
        });
    }
}
