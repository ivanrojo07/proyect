<?php

namespace App\Incidente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistroIncidente extends Model
{
    //
    use SoftDeletes;

    protected $fillable=[
    	'descripcion',
        'locacion',
    	'lat_especifica',
    	'long_especifica',
    	'lugares_afectados',
    	'fecha_ocurrencia',
    	'hora_ocurrencia',
    	'afectacion_vial',
    	'afectacion_infraestructural',
    	'danio_colateral',
    	'estatus',
    	'medidas_control',
    	'personas_afectadas',
    	'personas_lesionadas',
    	'personas_fallecidas',
    	'personas_desaparecidas',
    	'personas_evacuadas',
    	'dependencia',
    	'nombre_empleado',
    	'cargo_empleado'
    ];

    protected $hidden =[
        'catalogo_incidente_id',
        'estado_id',
        'municipio_id',
        'tipo_seguimiento_id',
        'tipo_impacto_id',
        'user_id',
        'registro_incidente_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function catalogo_incidente(){
    	return $this->belongsTo('App\Incidente\CatalogoIncidente');
    }

    public function estado(){
    	return $this->belongsTo('App\Estado');
    }

    public function municipio()
    {
        return $this->belongsTo('App\Municipio');
    }

    public function impacto(){
    	return $this->belongsTo('App\Incidente\TipoImpacto','tipo_impacto_id','id');
    }

    public function seguimiento(){
    	return $this->belongsTo('App\Incidente\TipoSeguimiento','tipo_seguimiento_id','id');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function incidente_siguiente(){
    	return $this->hasOne('App\Incidente\RegistroIncidente','registro_incidente_id','id');
    }

    public function incidente_previo(){
        return $this->belongsTo('App\Incidente\RegistroIncidente','registro_incidente_id','id');
    }

    public function localidades()
    {
        return $this->BelongsToMany('App\Localidad','localidad_registro_incidentes', 'registro_incidente_id','localidad_id')->withTimestamps();
    }

    public function dependencia_llamada(){
        return $this->hasOne('App\Dependencia\Dependencia','registro_incidente_id','id');
    }

    public function dependencia_reportes()
    {
        return $this->hasMany('App\Dependencia\ReporteDependencia','registro_incidente_id','id');
    }
}