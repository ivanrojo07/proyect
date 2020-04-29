<?php

namespace App\Covid;

use Illuminate\Database\Eloquent\Model;

class Covid extends Model
{
    //

    protected $fillable=[
    	// 'p1',
    	// 'p2',
    	// 'p3',
    	// 'p4',
    	// 'p5',
    	// 'p6',
    	// 'p7',
    	'convivir_enfermo',
    	'fiebre',
		'dolor_cabeza',
		'tos',
		'dolor_pecho',
		'dolor_garganta',
		'dificultad_respirar',
		'escurrimiento_nasal',
		'dolor_cuerpo',
		'conjuntivitis',
		'condiciones_medicas',
		'embarazada',
		'meses_embarazo',
		'dias_sintomas',
		'dolor_respirar',
		'falta_aire',
		'coloracion_azul',
    	'lat',
    	'lng',
    	'fecha',
    	'hora',
    	'proyecto',
    	'origen',
    	'perfil',
    	'rango',
    	'nivel'
    ];

    protected $hidden = [
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
