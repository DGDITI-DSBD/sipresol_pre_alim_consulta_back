<?php

namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoVulnerado extends Model
{
    use HasFactory;

    protected $table = 'cat_grupo_vulnerable';

    public $timestamps= false;


    protected $fillable = [
        'grupo',
        'caracteristicas',
    ];
}
