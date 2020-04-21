<?php

namespace App\Incidente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function subcategorias(){
    	return $this->hasMany('App\Incidente\SubcategoriaIncidente','categoria_id','id');
    }
}
