<?php

namespace App\Dependencia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReporteDependencia extends Model
{
    //

    use SoftDeletes;

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

    protected $hidden=[
    	'registro_incidente_id',
    	'created_at',
  		'updated_at',
  		'deleted_at'
    ];

    /**
     * Obtiene el registro del incidente al que se realiza dicho reporte
     *
     * @return \Illuminate\Database\Relations\BelongsTo
     */
    public function registro_incidente()
    {
    	return $this->belongsTo('App\Incidente\RegistroIncidente','registro_incidente_id','id');
    }
}
