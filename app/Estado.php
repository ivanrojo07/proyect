<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{
    //
    use SoftDeletes;

    protected $fillable=[
    	// 'id',
    	'nombre',
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at',
    	'deleted_at',
        'pivot'
    ];

    public function pais()
    {
        return $this->belongsTo('App\Pais');
    }

   	public function municipios(){
   		return $this->hasMany("App\Municipio");
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
     * Obtener los incidentes que se presentaron en el estado
     *
     * @return \Illuminate\Database\Relations\HasMany
     */
    public function registro_incidentes()
    {
        return $this->hasMany('App\Incidente\RegistroIncidente');
    }
}
