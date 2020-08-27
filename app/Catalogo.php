<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/***************************************
 *									   *
 *		Catalogos agregados			   *
 *									   * 
 **************************************/
class Catalogo extends Model
{
    //

    protected $fillable=['nombre'];
    protected $hidden = ['created_at','updated_at','deleted_at'];

    /**
     * Obtiene los tipo de incidentes de este catalogo
     *
     * @return \Illuminate\Database\Relations\hasMany
     */
    public function incidentes()
    {
    	return $this->hasMany('App\Incidente\CatalogoIncidente');
    }

    

}
