<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PadronActivo extends Model
{
    use HasFactory;

    protected $table = 'padron_activo';

    

    protected $fillable = [
        'id',
        'folio_relacionado',
        'curp',
        'primer_ap',
        'segundo_ap',
        'nombres',
        'cve_municipio',
        'municipio'
    ];

    public $timestamps = false;


}
