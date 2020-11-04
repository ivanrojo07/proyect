<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodigoPostal extends Model
{
    //
    protected $fillable=[
    	'codigo',//CODIGO POSTAL DE ASENTAMIENTO
		'asentamiento',//NOMBRE DE  ASENTAMIENTO
		'tipo_asentamiento',//TIPO DE  ASENTAMIENTO
		'municipio',//NOMBRE DEL MUNICIPIO
		'estado',//NOMBRE DEL ESTADO
		'ciudad',//NOMBRE DE LA CIUDAD
		'codigo_postal',//Código Postal de la Administración Postal que reparte al asentamiento
		'codigo_estado',//Clave Entidad 
		'codigo_oficina',//Código Postal de la Administración Postal que reparte al asentamiento
		'codigo_postal_c',// c_CP Campo Vacio
		'codigo_tipo_asentamiento',//Clave Tipo de asentamiento 
		'codigo_municipio',//Clave Municipio
		'id_asentamiento_cpcons',//Identificador único del asentamiento
		'zona',//Zona en la que se ubica el asentamiento 
		'clave_ciudad'// Clave Ciudad 
    ];
    protected $hidden = [
    	'created_at',
    	'updated_at'
    ];
}
