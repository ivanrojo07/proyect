<?php

namespace App\Incidente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prioridad extends Model
{
	use SoftDeletes;
    //
    protected $fillable=[
    	'nombre'
    ];
    protected $hidden=[
    	'created_at',
    	'deleted_at',
    	'updated_at'
    ];

    public function catalogo_incidentes(){
    	return $this->hasMany('App\Incidente\CatalogoIncidente');
    }
}
