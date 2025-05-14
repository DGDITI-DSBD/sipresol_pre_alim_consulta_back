<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class si_cat_dominios extends Model
{
    use HasFactory;

    protected $table = 'si_cat_dominios';
    
    
    public $timestamps = false;

    protected $primaryKey = 'id_sigesp';

    protected $fillable = [
        'id_sigesp',
        'dominio_mail',
        'no_status'
    ];
}
