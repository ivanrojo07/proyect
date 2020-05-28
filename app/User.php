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
     * Crea un atributo con el nombre completo del usuario
     *
     */
    public function getFullNameAttribute()
    {
        return ucfirst($this->nombre)." ".ucfirst($this->apellido_paterno)." ".ucfirst($this->apellido_materno);
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
