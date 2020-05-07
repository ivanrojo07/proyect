<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipio extends Model
{
    //
    use SoftDeletes;

    protected $fillable=[
    	'id',
    	'nombre',
		'lat',
		'long',
		'estado_id',
    ];

    protected $hidden=[
        'estado_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'pivot'
    ];

    public function estado(){
    	return $this->belongsTo('App\Estado');
    }

    public function localidads(){
    	return $this->hasMany('App\Localidad');
    }

    public function users(){
        return $this->hasMany('App\User');
    }
}
