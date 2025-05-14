<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class si_cat_estado_civil extends Model
{
    use HasFactory;

    protected $table = 'cat_edo_civil';
    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'estado_civil',
        'anio'
    ];
}
