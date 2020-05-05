<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'tipo_catalogo',
        'id_edo',
        'id_mun',
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

    public function estado(){
        return $this->belongsTo('App\Estado','id_edo','id');
    }

    public function municipio(){
        return $this->belongsTo('App\Municipio','id_mun','id');
    }

    public function registro_covids(){
        return $this->hasMany('App\Covid\Covid');
    }
    
    public function institucion(){
        return $this->belongsTo('App\Roles\Institucion');
    }
}
