<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRowsToCovidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('covids', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedInteger('edad');
            $table->string('genero');
            $table->string('cp');
            $table->string('score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('covids', function (Blueprint $table) {
            //
            $table->dropColumn(['id_usuario','edad','genero','cp','score']);
        });
    }
}
