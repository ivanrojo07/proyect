<?php

namespace App\Dependencia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dependencia extends Model
{
    //
    use SoftDeletes;

    protected $fillable=[
    	// 'registro_incidente_id',
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

    protected $hidden = [
        'registro_incidente_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Obtiene el registro del incidente del cual se realizo la llamada de dependencia
     *
     * @return \Illuminate\Database\Relations\BelongsTo
     */
    public function registro_incidente()
    {
    	return $this->belongsTo('App\Incidente\RegistroIncidente','registro_incidente_id','id');
    }
}
