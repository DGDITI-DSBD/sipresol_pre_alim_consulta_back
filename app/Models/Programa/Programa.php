<?php

namespace App\Models\Programa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Programa\Apoyo;
use App\Models\Programa\Calendario;
use App\Models\Registro\Registro;

class Programa extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'cat_programas';

    // Define the primary key for the table
    protected $primaryKey = 'id';

    // Specify if the primary key is auto-incrementing
    public $incrementing = true;

    // Specify the data type of the primary key
    protected $keyType = 'int';

    // Specify if the model should be timestamped
    public $timestamps = true;

    // Define the fillable attributes
    protected $fillable = [
        'r_secretaria',
        'organismo_ejecutor',
        'unidad_ejecutora',
        'nombre_del_programa',
        'vertiente',
        'anio',
        'periodicidad',
        'trimestre',
        'edad_min',
        'edad_max',
        'estado',
        'generos',
        'grupo_vuln_poblacion_atendida',
    ];

    // Define any relationships with other models
    public function apoyos()
    {
        return $this->hasMany(Apoyo::class);
    }

    // Define any relationships with other models
    public function calendario()
    {
        return $this->hasMany(Calendario::class);
    }

    // Define any relationships with other models
    public function registros()
    {
        return $this->hasMany(Registro::class);
    }

}