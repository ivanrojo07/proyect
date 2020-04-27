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


    public function categoria(){
    	return $this->belongsTo('App\Incidente\CategoriaIncidente','categoria_id','id');
    }

    public function catalogos(){
    	return $this->hasMany('App\Incidente\CatalogoIncidente','subcategoria_id','id');
    }
}
