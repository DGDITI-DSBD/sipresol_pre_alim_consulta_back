<?php

namespace App\Models\Registro;

use App\Models\Programa\Opcion;
use App\Models\Programa\Pregunta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;




class Respuesta extends Model
{
    use HasFactory;
    
    protected $table = 'respuestas';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'registro_id',
        'pregunta_id',
        'respuesta_texto',
        'respuesta_si_no',
        'respuesta_numero',
        'calificacion'
    ];

    protected $casts = [
        'respuesta_si_no' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function registro(): BelongsTo
    {
        return $this->belongsTo(Registro::class);
    }

  

   

    public function padre(): BelongsTo
    {
        return $this->belongsTo(Respuesta::class, 'respuesta_padre_id');
    }


    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class)
            ->with('subpreguntas', 'opciones');
    }

    public function subpreguntas()
    {
        return $this->hasMany(Respuesta::class, 'respuesta_padre_id')
            ->with('pregunta', 'opciones');
    }

    public function opciones(): BelongsToMany
    {
        return $this->belongsToMany(Opcion::class, 'respuestas_opciones')
            ->withPivot('cantidad');
    }

    // Accesor dinámico para la respuesta
    public function getValorAttribute()
    {
        return match ($this->pregunta->tipo_pregunta) {
            'si_no' => $this->respuesta_si_no,
            'numero' => $this->respuesta_numero,
            'texto_libre' => $this->respuesta_texto,
            'opcion_unica' => $this->opciones->first(),
            default => $this->opciones
        };
    }
}