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

    /**
     * Obtiene el catalogo de incidente que pertenece este registro
     *
     * @return \Illuminate\Database\Relations\BelongsTo
     */
    public function catalogo_incidente(){
    	return $this->belongsTo('App\Incidente\CatalogoIncidente');
    }

    /**
     * Obtiene el estado al que pertenece dicho registro
     *
     *  @return \Illuminate\Database\Relations\BelongsTo
     */
    public function estado(){
    	return $this->belongsTo('App\Estado');
    }

    /**
     * Obtener el municipio al que pertenece dicho registro
     *
     * @return \Illuminate\Database\Relations\BelongsTo
     */
    public function municipio()
    {
        return $this->belongsTo('App\Municipio');
    }

    /**
     * Obtiene el tipo de impacto que pertenece dicho registro
     *
     * @return \Illuminate\Database\Relations\BelongsTo
     */
    public function impacto(){
    	return $this->belongsTo('App\Incidente\TipoImpacto','tipo_impacto_id','id');
    }

    /**
     * Obtiene el tipo de seguimiento que pertenece dicho registro
     *
     * @return \Illuminate\Database\Relations\BelongsTo
     */
    public function seguimiento(){
    	return $this->belongsTo('App\Incidente\TipoSeguimiento','tipo_seguimiento_id','id');
    }

    /**
     * Obtiene al usuario que registro este incidente
     *
     * @return \Illuminate\Database\Relations\BelongsTo
     */
    public function user(){
    	return $this->belongsTo('App\User');
    }

    /**
     * Si este registro es sucesor a un incidente actualizado, se muestra el incidente actualizado
     *
     * @return \Illuminate\Database\Relations\HasOne
     */
    public function incidente_siguiente(){
    	return $this->hasOne('App\Incidente\RegistroIncidente','registro_incidente_id','id');
    }

    /**
     * Si el registro tiene un registro anterior, este se muestra
     *
     * @return \Illuminate\Database\Relations\BelongsTo
     */
    public function incidente_previo(){
        return $this->belongsTo('App\Incidente\RegistroIncidente','registro_incidente_id','id');
    }

    /**
     * Obtiene las localidades que esta afectando este registro
     *
     * @return \Illuminate\Database\Relations\BelongsTo
     */
    public function localidades()
    {
        return $this->BelongsToMany('App\Localidad','localidad_registro_incidentes', 'registro_incidente_id','localidad_id')->withTimestamps();
    }

    /**
     * Si el registro se hizo por la api, este tendra una nueva imformaciÓn sobre la llamada a la dependencia
     *
     * @return \Illuminate\Database\Relations\HasOne
     */
    public function dependencia_llamada(){
        return $this->hasOne('App\Dependencia\Dependencia','registro_incidente_id','id');
    }

    /**
     * Se muestra los reportes de la dependencia a este incidente
     *
     * @return \Illuminate\Database\Relations\HasMany
     */
    public function dependencia_reportes()
    {
        return $this->hasMany('App\Dependencia\ReporteDependencia','registro_incidente_id','id');
    }

    // Accesor para estatus
    public function getEstatusAttribute($value)
    {
        return ($value == true ? 'Activo' : 'Inactivo');
    }
}