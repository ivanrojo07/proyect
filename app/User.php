<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'email',
        'password',
        'claro_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
        'tipo_catalogo',
        'id_edo',
        'id_mun',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     *  Mutador para que el nombre sea en mayuscula
     *
     *  @param  string  $value
     *
     *  @return string 
     */
    public function getNombreAttribute($value)
    {
        return ucwords($value);
    }

    /**
     *  Mutador para que el nombre sea en mayuscula
     *
     *  @param  string  $value
     *
     *  @return string 
     */
    public function getApellidoPaternoAttribute($value)
    {
        return ucwords($value);
    }

    /**
     *  Mutador para que el nombre sea en mayuscula
     *
     *  @param  string  $value
     *
     *  @return string 
     */
    public function getApellidoMaternoAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtolower($value);
    }

    /**
     * Set the user's apellido paterno.
     *
     * @param  string  $value
     * @return void
     */
    public function setApellidoPaternoAttribute($value)
    {
        $this->attributes['apellido_paterno'] = strtolower($value);
    }

    /**
     * Set the user's apellido materno.
     *
     * @param  string  $value
     * @return void
     */
    public function setApellidoMaternoAttribute($value)
    {
        $this->attributes['apellido_materno'] = strtolower($value);
    }

    /**
     * Crea un atributo con el nombre completo del usuario
     *
     */
    public function getFullNameAttribute()
    {
        return ucwords($this->nombre)." ".ucwords($this->apellido_paterno)." ".ucwords($this->apellido_materno);
    }

    /**
    * Obtener relación con los registros de covid-19 que realizo el usuario 
    * 
    * @return \Illuminate\Database\Eloquent\Relations\HasMany|null
    */
    public function registro_covids(){
        return $this->hasMany('App\Covid\Covid');
    }

    /**
     * Obtener los registro de incidentes que realizo el usuario
     *
     * @return \Illuminate\Database\Relations\HasMany
     */
    public function registro_incidentes()
    {
        return $this->hasMany('App\Incidente\RegistroIncidente');
    }
    
    /**
    * Obtener la institucion a la que pertenece este usuario
    * 
    * @return \Iluminate\Database\Eloquent\Relations\BelongsTo|null
    */
    public function institucion(){
        return $this->belongsTo('App\Roles\Institucion');
    }

}
