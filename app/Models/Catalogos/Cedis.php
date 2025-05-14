<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cedis extends Model
{
    use HasFactory;

    protected $table = 'cat_cedis';

    public $timestamps= false;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nombre',
        'municipio_id',
        'direccion',
        'capacidad'
    ];
}
