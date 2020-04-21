<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Localidad extends Model
{
    //
    use SoftDeletes;

    protected $fillable=[
    	'id',
    	'nombre',
		'lat',
		'long',
		'municipio_id',
    ];

    protected $hidden = [
        'municipio_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'pivot'
    ];

    public function municipio(){
    	return $this->belongsTo('App\Municipio');
    }

    public function incidentes(){
        return $this->belongsToMany('App\Incidente\RegistroIncidente','localidad_registro_incidentes','localidad_id')->withTimestamps();
    }
}

