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

    public function getFullNameAttribute()
    {
        return ucfirst($this->nombre)." ".ucfirst($this->apellido_paterno)." ".ucfirst($this->apellido_materno);
    }

    public function registro_covids(){
        return $this->hasMany('App\Covid\Covid');
    }
    
    public function institucion(){
        return $this->belongsTo('App\Roles\Institucion');
    }
}
