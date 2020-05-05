<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInstitucionKeyToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn(['id_mun','id_edo','tipo_catalogo']);
            $table->unsignedBigInteger('institucion_id')->nullable()->after('password');
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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->bigInteger('id_mun')->nullable();
            $table->bigInteger('id_edo')->nullable();
            $table->string('tipo_catalogo')->nullable();
            $table->dropForeign(['institucion_id']);
            $table->dropColumn('institucion_id');
        });
    }
}
