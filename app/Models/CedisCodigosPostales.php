<?php

namespace App\Models;

use App\Models\Catalogos\Cedis;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CedisCodigosPostales extends Model
{
    use HasFactory;

    protected $table = 'cedis_codigos_postales';
    protected $fillable = [
        'cedis_id',
        'codigo_postal'
    ];

    public $timestamps = false;

    public function datos_cedis()
    {
        return $this->belongsTo(Cedis::class, 'cedis_id');
    }

}