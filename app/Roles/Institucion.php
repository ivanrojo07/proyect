<?php

namespace App\Roles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institucion extends Model
{
	use SoftDeletes;
    //
    protected $fillable=[
    	'nombre',
    	'tipo_institucion',
    	'path_imagen_header',
		'path_imagen_header2',
		'path_imagen_favicon',
		'path_imagen_footer'
    ];

    public function usuarios()
    {
    	return $this->hasMany('App\User');
    }

    public function categorias_incidente(){
    	return $this->belongsToMany('App\Incidente\CategoriaIncidente','categoria_incidente_institucion')->withTimestamps();
    }

    /**
     * obtiene todos los estados asignados a esta institucion.
     */
    public function estados()
    {
        return $this->morphedByMany('App\Estado', 'regionable')->withTimestamps();
    }

    /**
     * obtiene todos los municipios asignados a esta institucion.
     */
    public function municipios()
    {
        return $this->morphedByMany('App\Municipio', 'regionable')->withTimestamps();
    }
}
