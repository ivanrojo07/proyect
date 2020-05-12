<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Localidad extends Model
{
    //
    use SoftDeletes;

    protected $fillable=[
    	'id',
    	'nombre',
		'lat',
		'long',
		'municipio_id',
    ];

    protected $hidden = [
        'municipio_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'pivot'
    ];

    /**
     * Obtener el municipio que pertenece esta localidad
     *
     * @return \Illuminate\Database\Relations\BelongsTo
     */
    public function municipio(){
    	return $this->belongsTo('App\Municipio');
    }

    /**
     * Obtener los incidentes que involucren este municipio
     *
     *  @return \Illuminate\Database\Relations\BelongsToMany
     */
    public function incidentes(){
        return $this->belongsToMany('App\Incidente\RegistroIncidente','localidad_registro_incidentes','localidad_id')->withTimestamps();
    }
}

