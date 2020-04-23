<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReporteDependenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporte_dependencias', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('registro_incidente_id');
            
            $table->string('zp')->nullable();
            $table->string('sector')->nullable();
            $table->string('cuadrante')->nullable();
            $table->time('h_lectura')->nullable();
            $table->string('motivo');
            $table->text('observacion')->nullable();
            $table->timestamp('f_transmision')->nullable();
            $table->string('atencion')->default('1');
            $table->string('razonamiento')->nullable();
            $table->timestamp('f_razonamiento')->nullable();
            $table->text('obs_noatencion')->nullable();
            $table->string('nombre_encargado')->nullable();
            $table->string('razon_noatencion')->nullable();
            $table->string('dependencia')->nullable();
            $table->string('folio')->nullable();

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
        Schema::dropIfExists('reporte_dependencias');
    }
}
