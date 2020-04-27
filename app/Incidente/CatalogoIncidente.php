<?php

namespace App\Incidente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatalogoIncidente extends Model
{
	use SoftDeletes;
	
    //


    protected $fillable = [
    	'clave',
		'nombre'
    ];

    protected $hidden = [
        'prioridad_id',
        'subcategoria_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function getNombreAttribute($value){
        return ucfirst($value);
    }

    public function registro_incidentes(){
    	return $this->hasMany('App\Incidente\RegistroIncidente');

    }

    public function prioridad(){
    	return $this->belongsTo('App\Incidente\Prioridad');
    }

    public function subcategoria(){
        return $this->belongsTo('App\Incidente\SubcategoriaIncidente','subcategoria_id','id');
    }
    

}
