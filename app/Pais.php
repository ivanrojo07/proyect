<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/********************
 *                  *
 *      Paises      *
 *                  *
 ********************/
class Pais extends Model
{
    //

    protected $fillable=[
    	'nombre'
    ];

    /**
     * Obtiene la estados que pertenecen a este Pais
     *
     * @return \Illuminate\Database\Relations\BelongsTo
     */
    public function estados()
    {
    	return $this->hasMany('App\Estado');
    }
}
