<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class si_cat_sepomex extends Model
{
    use HasFactory;


    protected $table = 'cat_codigos_postales';

    public $timestamps = false;

    protected $primaryKey = "asentamiento_id";

    protected $fillable = [
        'codigo_postal',
        'asentamiento_id',
        'asentamiento',
        'municipio_id',
        'municipio',
        'anio'
    ];
}
