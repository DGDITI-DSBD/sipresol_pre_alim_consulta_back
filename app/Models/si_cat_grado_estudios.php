<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class si_cat_grado_estudios extends Model
{
    use HasFactory;

    protected $table = 'cat_escolaridad';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'escolaridad',
        'anio'
    ];

    public $timestamps = false;
    public $incrementing = false;
}
