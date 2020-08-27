<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/************************************
 *                                  *
 *      Municipio de los Estados    *
 *                                  *
 ************************************/
class Municipio extends Model
{
    //
    use SoftDeletes;

    /**
     * Los atributos que pueden ser asignables masivamente
     *
     * @var array
     */
    protected $fillable=[
    	'id',
    	'nombre',
		'lat',
		'long',
		'estado_id',
    ];

    /**
     * Los atributos que se esconderan desde el array o la respuesta json
     *
     */
    protected $hidden=[
        'estado_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'pivot'
    ];

    /**
     * Obtener relación con el estado al que pertenece dicho municipio
     *
     * @return \Illuminate\Dabatabase\Eloquent\Relations\BelongsTo
     */
    public function estado(){
    	return $this->belongsTo('App\Estado');
    }

    /**
     * Obtener relación con las localidades que tiene este municipio
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function localidads(){
    	return $this->hasMany('App\Localidad');
    }

    /**
     * Obtener las instituciones a la que pertenece
     *
     * @return \Illuminate\Database\Relations\MorphToMany
     */
    public function institucions(){
        return $this->morphToMany('App\Roles\Institucion','regionable');
    }

    /** 
     * Obtener los incidentes que se presentaron en el municipio
     *
     * @return \Illuminate\Database\Relations\HasMany
     */
    public function registro_incidentes()
    {
        return $this->hasMany('App\Incidente\RegistroIncidente');
    }
}
