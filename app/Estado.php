<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{
    //
    use SoftDeletes;

    protected $fillable=[
    	// 'id',
    	'nombre',
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at',
    	'deleted_at',
      'pivot'
    ];

   	public function municipios(){
   		return $this->hasMany("App\Municipio");
   	}


}
