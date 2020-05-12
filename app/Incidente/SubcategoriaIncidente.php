<?php

namespace App\Incidente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubcategoriaIncidente extends Model
{
	use SoftDeletes;
    //
    protected $fillable=[
    	'nombre'
    ];

    protected $hidden=[
        'categoria_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Obtiene la categoria que pertenece esta subcategoria
     *
     * @return \Illuminate\Database\Relations\BelongsTo
     */
    public function categoria(){
    	return $this->belongsTo('App\Incidente\CategoriaIncidente','categoria_id','id');
    }

    /**
     * Obtiene todo el catalogo de incidente con ese tipo de subcategoria
     *
     * @return \Illuminate\Database\Relations\HasMany
     */
    public function catalogos(){
    	return $this->hasMany('App\Incidente\CatalogoIncidente','subcategoria_id','id');
    }
}
