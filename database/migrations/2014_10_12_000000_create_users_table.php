<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno')->nullable();
            $table->string('tipo_catalogo')->nullable();
            // No me complico, registro el id 
            // del estado si es una entidad estatal
            // Si es nulo, es de una entidad federal
            $table->bigInteger('id_edo')->nullable();
            // Si es una entidad municipal, se llena
            // el id del municipio, de lo contrario,
            // si es nulo, es una entidad estatal
            $table->bigInteger('id_mun')->nullable();

            $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
