<?php

namespace App\Dependencia;

use Illuminate\Database\Eloquent\Model;

class ReporteDependencia extends Model
{
    //

    protected $fillable=[
    	'zp',
		'sector',
		'cuadrante',
		'h_lectura',
		'motivo',
		'observacion',
		'f_transmision',
		'atencion',
		'razonamiento',
		'f_razonamiento',
		'obs_noatencion',
		'nombre_encargado',
		'razon_noatencion',
		'dependencia',
		'folio'
    ];

    public function registro_incidente()
    {
    	return $this->belongsTo('App\Incidente\RegistroIncidente','registro_incidente_id','id');
    }
}
