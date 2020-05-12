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

    /**
     * Convierte el nombre en la primera letra en mayuscula
     *
     * @return string
     */
    public function getNombreAttribute($value){
        return ucfirst($value);
    }

    /**
     * Obtiene los registros de incidente que esten catalogados como este incidente
     *
     * @return \Illuminate\Database\Relations\HasMany
     */
    public function registro_incidentes(){
    	return $this->hasMany('App\Incidente\RegistroIncidente');

    }

    /**
     * Obtiene la prioridad de este incidente
     *
     * @return \Illuminate\Database\Relations\BelongsTo
     */
    public function prioridad(){
    	return $this->belongsTo('App\Incidente\Prioridad');
    }

    /**
     * Obtiene la subcategoria que pertenece este Catalogo
     *
     * @return \Illuminate\Database\Relations\BelongsTo
     */
    public function subcategoria(){
        return $this->belongsTo('App\Incidente\SubcategoriaIncidente','subcategoria_id','id');
    }

}