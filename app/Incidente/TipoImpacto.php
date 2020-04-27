<?php

namespace App\Incidente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoImpacto extends Model
{
	use SoftDeletes;
    //
    protected $fillable=[
    	'nombre'
    ];

    protected $hidden =[
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    public function getNombreAttribute($value)
    {
    	return ucfirst($value);
    }
}
