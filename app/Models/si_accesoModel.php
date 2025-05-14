<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class si_accesoModel extends Authenticatable implements JWTSubject
{
    //use HasApiTokens, Notifiable;
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    use HasFactory;


    protected $table = 'si_acceso';
    protected $primaryKey = 'id';

    protected $fillable = [
        'folio_dependencia',
        'usuario',
        'contrasena',
        'status',
        'tipo_usuario',
        'rol',
        'privilegio'
    ];

    public $timestamps = false;
    public $incrementing = false;
}
