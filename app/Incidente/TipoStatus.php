<?php

namespace App\Incidente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoStatus extends Model
{
	use SoftDeletes;
    //
    protected $fillable=[
    	'nombre'
    ];
}
