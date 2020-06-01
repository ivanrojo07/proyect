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
    protected $hidden = ['pivot'];

    /**
     * Set the institucion's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtolower($value);
    }

    /**
     *  Mutador para que el nombre sea en mayuscula
     *
     *  @param  string  $value
     *
     *  @return string 
     */
    public function getNombreAttribute($value)
    {
        return ucwords($value);
    }


    /**
     * Obtener los usuarios que pertenecen esta institucion
     *
     * @return \Illuminate\Database\Relations\HasMany
     */
    public function usuarios()
    {
    	return $this->hasMany('App\User');
    }

    /**
     * Obtener las categorias incidentes que puede crear esta institucion
     *
     *  @return \Illuminate\Database\Relations\BelongsToMany
     */
    public function categorias_incidente(){
    	return $this->belongsToMany('App\Incidente\CategoriaIncidente','categoria_incidente_institucion')->withTimestamps();
    }

    /**
     * obtiene todos los estados asignados a esta institucion.
     * 
     * @return \Illuminate\Database\Relations\MorphedByMany
     */
    public function estados()
    {
        return $this->morphedByMany('App\Estado', 'regionable')->withTimestamps();
    }

    /**
     * obtiene todos los municipios asignados a esta institucion.
     * 
     * @return \Illuminate\Database\Relations\MorphedByMany
     */
    public function municipios()
    {
        return $this->morphedByMany('App\Municipio', 'regionable')->withTimestamps();
    }

    public function registro_incidentes(){
        return $this->hasManyThrough(
            'App\Incidente\RegistroIncidente',
            'App\User',
            'institucion_id',
            'user_id'
        );
    }

}
