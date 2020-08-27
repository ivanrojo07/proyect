<?php

namespace App\Incidente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/*********************************************
 *                                           *
 *      Categoria de incidentes              *
 *                                           *
 *********************************************/
class CategoriaIncidente extends Model
{
	use SoftDeletes;
    //
    protected $fillable=[
    	'nombre'
    ];
    protected $hidden=[
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    /**
     * Se muestra todas las subcategorias que tiene esta categoria
     *
     * @return \Illuminate\Database\Relations\HasMany
     */
    public function subcategorias(){
    	return $this->hasMany('App\Incidente\SubcategoriaIncidente','categoria_id','id');
    }

    /**
     * Obtiene todo el catalogo nacional de incidente de las subcategorias.
     *
     * @return \Illuminate\Database\Relations\HasManyThrough
     */
    public function catalogo_incidentes()
    {
        return $this->hasManyThrough(
            'App\Incidente\CatalogoIncidente',
            'App\Incidente\SubcategoriaIncidente',
            'categoria_id',
            'subcategoria_id'
        );
    }
}
