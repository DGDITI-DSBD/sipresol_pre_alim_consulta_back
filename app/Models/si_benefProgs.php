<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class si_benefProgs extends Model
{
    use HasFactory;

    protected $table = 'si_benef_progs';

    protected $fillable = [
        'id_si'    ,
        'curp',
        'no_status',
        'cve_programa'
    ];

    public $timestamps = false;
    public $incrementing = false;


}
