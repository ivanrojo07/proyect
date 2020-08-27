<?php

namespace App\Incidente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/*********************************************
 *                                           *
 *   Seguimiento que se dará al Incidente    *
 *                                           *
 *********************************************/
class TipoSeguimiento extends Model
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
     *  Obtiene el nombre un capitalcase (primera en mayuscula)
     *
     * @return string
     */
    public function getNombreAttribute($value)
    {
    	return ucfirst($value);
    }

    /**
     * Obtiene todos los incidentes con ese tipo de seguimiento
     *
     * @return \Illuminate\Database\Relations\HasMany
     */
    public function registro_incidentes()
    {
        return $this->hasMany('App\Incidente\RegistroIncidente');
    }


}
