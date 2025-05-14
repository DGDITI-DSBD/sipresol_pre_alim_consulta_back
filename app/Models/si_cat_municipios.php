<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class si_cat_municipios extends Model
{

    protected $table = 'cat_municipios';

    public $timestamps = false;

    protected $fillable = [
        'entidad_federativa_id',
        'cve_municipio',
        'municipio',
        'region_id'
    ];
}
