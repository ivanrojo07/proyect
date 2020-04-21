<?php

namespace App\Dependencia;

use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    //

    protected $fillable=[
    	'registro_incidente_id',
    	'datos_llamada',
    	'tiempo_llamada',
    	'tiempo_atencion',
    	'descripcion_llamada'
    ];

    protected $casts = [
    	'datos_llamada' => 'object',
    	'tiempo_llamada' => 'object',
    	'tiempo_atencion' => 'object',
    	'descripcion_llamada' => 'object',
    ];

    public function registro_incidente()
    {
    	return $this->belongsTo('App\Incidente\RegistroIncidente','registro_incidente_id','id');
    }
}
