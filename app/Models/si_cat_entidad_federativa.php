<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class si_cat_entidad_federativa extends Model
{
    use HasFactory;


    protected $table = 'cat_entidad_federativa';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'entidad_federativa',
        'abreviatura_entidad_federativa'
    ];

    public $timestamps = false;
}
