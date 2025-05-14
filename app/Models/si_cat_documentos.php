<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class si_cat_documentos extends Model
{
    use HasFactory;

    protected $table = 'cat_id_oficial';

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = [
        'anio',
        'id',
        'tp_id_oficial',
        'no_status'
    ];
}
