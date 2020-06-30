<?php

namespace App\Incidente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Serie extends Model
{

	protected static function booted()
    {
        // Crea el id antes de que se grabe el registro en la base de datos por medio del handler create
        static::creating(function ($serie) {
            //ID = Año.Mes.Dia.TotalDeRegistrosEnLaBD
            $serie->id = intval(Date('Ymd').count(DB::select('select * from series')));
        });
        // Crea el id antes de que se grabe el registro en la base de datos por medio del handler save
        static::saving(function ($serie) {
            // ID = Año.Mes.Dia.TotalDeRegistrosEnLaBD
            $serie->id = intval(Date('Ymd').count(DB::select('select * from series')));
        });
    }
    //
    protected $fillable=[
    	'catalogo_incidente_id',
    	'estado_id'
    ];

    public function catalogo_incidente()
    {
    	return $this->belongsTo('App\Incidente\CatalogoIncidente');
    }

    public function estado(){
    	return $this->belongsTo('App\Estado');
    }

    public function registro_incidentes()
    {
    	return $this->hasMany('App\Incidente\RegistroIncidente');
    }
}
