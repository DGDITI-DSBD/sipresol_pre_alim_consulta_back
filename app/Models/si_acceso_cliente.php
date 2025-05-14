<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class si_acceso_cliente extends Authenticatable
{
    use HasApiTokens, Notifiable;


    protected $table = 'si_acceso_cliente';

    protected $primarykey = 'si_folio';

    protected $fillable = [
            'si_folio',
            'primer_apellido',
            'segundo_apellido',
            'nombre',
            'cve_entidad_nacimiento',
            'fecha_nacimiento',
            'no_status'
    ];


}
