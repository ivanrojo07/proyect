<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covids', function (Blueprint $table) {
            $table->id();
            // PREGUNTAS
            // $table->string("p1");
            // $table->string("p2");
            // $table->string("p3");
            // $table->string("p4");
            // $table->string("p5");
            // $table->string("p6");
            // $table->string("p7");
            $table->integer('convivir_enfermo');
            $table->integer('fiebre');
            $table->integer('dolor_cabeza');
            $table->integer('tos');
            $table->integer('dolor_pecho');
            $table->integer('dolor_garganta');
            $table->integer('dificultad_respirar');
            $table->integer('escurrimiento_nasal');
            $table->integer('dolor_cuerpo');
            $table->integer('conjuntivitis');
            $table->string('condiciones_medicas');
            $table->integer('embarazada');
            $table->integer('meses_embarazo');
            $table->integer('dias_sintomas');
            $table->integer('dolor_respirar');
            $table->integer('falta_aire');
            $table->integer('coloracion_azul');
            // LOCACIóN 
            $table->decimal('lat',10,7);
            $table->decimal('lng',10,7);
            $table->date('fecha');
            $table->time('hora');
            $table->string('proyecto')->default('sedena');
            $table->string('origen')->default('Web');
            $table->json('perfil')->nullable();
            $table->bigInteger('rango')->nullable();
            $table->string('nivel')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();
            // Llave foranea con usuario
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('covids');
    }
}
