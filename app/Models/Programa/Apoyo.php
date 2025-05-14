<?php

namespace App\Models\Programa;

use Illuminate\Database\Eloquent\Model;
use App\Models\Programa\Programa;


class Apoyo extends Model
{
    // Table name
    protected $table = 'cat_apoyos';

    // Primary key
    protected $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    // Fillable fields
    protected $fillable = [
        'programa_id',
        'tipo_apoyo',
        'nombre',
        'descripcion',
        'costo_unitario'
    ];

    // Hidden fields
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    //relacionalo con el programa un programa puede tener 1 o mas apoyos
    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }
}