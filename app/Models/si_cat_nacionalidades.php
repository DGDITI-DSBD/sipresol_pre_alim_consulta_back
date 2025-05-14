<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class si_cat_nacionalidades extends Model
{
    use HasFactory;

    protected $table = 'si_cat_nacionalidades';

    public $timestamps= false;

    protected $primaryKey = 'cve_pais';


    protected $fillable = [
        'cve_pais',
        'pais',
        'clave_nacionalidad'
    ];
}
