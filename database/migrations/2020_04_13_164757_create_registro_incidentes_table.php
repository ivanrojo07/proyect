<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroIncidentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_incidentes', function (Blueprint $table) {
            $table->id();
            // CATALOGO INCIDENTES
            $table->unsignedBigInteger('catalogo_incidente_id');
            $table->unsignedBigInteger('estado_id');
            $table->unsignedBigInteger('municipio_id')->nullable();
            $table->text('descripcion');
            $table->string('locacion')->nullable();
            $table->decimal('lat_especifica', 10, 7);
            $table->decimal('long_especifica', 10, 7);
            $table->text('lugares_afectados')->nullable();
            $table->date('fecha_registro')->nullable();
            $table->time('hora_registro')->nullable();
            $table->date('fecha_ocurrencia');
            $table->time('hora_ocurrencia');
            $table->string('afectacion_vial')->nullable();
            $table->string('afectacion_infraestructural')->nullable();
            $table->string('danio_colateral')->nullable();
            $table->boolean('estatus')->default(true);
            // TIPO_SEGUIMIENTOS
            $table->unsignedBigInteger('tipo_seguimiento_id');
            // NIVEL DE IMPACTO
            $table->unsignedBigInteger('tipo_impacto_id');

            $table->string('medidas_control')->nullable();
            $table->unsignedInteger('personas_afectadas')->default(0);
            $table->unsignedInteger('personas_lesionadas')->default(0);
            $table->unsignedInteger('personas_fallecidas')->default(0);
            $table->unsignedInteger('personas_desaparecidas')->default(0);
            $table->unsignedInteger('personas_evacuadas')->default(0);
            // respuesta institucional(por ver)

            $table->string('dependencia')->nullable();
            $table->string('nombre_empleado')->nullable();
            $table->string('cargo_empleado')->nullable();

            // DATOS EXTRAS DEL JSON DE UPDATE INCIDENTE

            $table->string('respuesta_institucional')->nullable();

            $table->string('id_usuario')->nullable();

            // Usuario que registro el incidente
            $table->unsignedBigInteger('user_id');

            // Si existe seguimiento de un registro previo
            // $table->unsignedBigInteger('registro_incidente_id')->nullable();
            $table->unsignedBigInteger('serie_id')->nullable();


            $table->timestamps();
            $table->softDeletes();

            // relaciones
            // obtener el incidente
            $table->foreign('catalogo_incidente_id')->references('id')->on('catalogo_incidentes');
            // obtener el estado
            $table->foreign('estado_id')->references('id')->on('estados');
            // obtener el municipio
            $table->foreign('municipio_id')->references('id')->on('municipios');
            // tipo de seguimiento
            $table->foreign('tipo_seguimiento_id')->references('id')->on('tipo_seguimientos');
            // tipo de impacto
            $table->foreign('tipo_impacto_id')->references('id')->on('tipo_impactos');
            // usuario que registro el incidente
            $table->foreign('user_id')->references('id')->on('users');

            // Relacion con series de incidentes
            $table->foreign('serie_id')->references('id')->on('series');
            // Si existe seguimiento de un registro previo
            // $table->foreign('registro_incidente_id')->references('id')->on('registro_incidentes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_incidentes');
    }
}
