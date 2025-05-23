<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class si_cat_localidades extends Model
{
    use HasFactory;

    protected $table = 'cat_localidades';

    public $timestamps = false;

    protected $primaryKey = "cve_localidad";

    protected $fillable = [
        "id",
        'municipio_id',
        'cve_localidad',
        'localidad',
        'anio'
    ];
}
