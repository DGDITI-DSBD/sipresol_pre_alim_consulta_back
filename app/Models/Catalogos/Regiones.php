<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regiones extends Model
{
    use HasFactory;

    protected $table = 'cat_regiones';

    public $timestamps= false;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'region_id',
        'descripcion'
    ];
}
