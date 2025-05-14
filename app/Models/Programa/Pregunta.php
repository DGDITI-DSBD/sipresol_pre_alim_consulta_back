<?php

namespace App\Models\Programa;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Programa\Programa;
use App\Models\Registro\Respuesta;
use App\Models\Programa\Opcion;


class Pregunta extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cat_preguntas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'programa_id',
        'numero_pregunta',
        'tipo_pregunta',
        'pregunta_descripcion',
        'requerido',
        'activo',
        'depende_de',
        'depende_respuesta',
    ];



    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'requerido' => 'boolean',
        'activo' => 'boolean',
        'depende_respuesta' => 'array',
    ];

    /**
     * Get the programa that owns the pregunta.
     */
    public function programa(): BelongsTo
    {
        return $this->belongsTo(Programa::class);
    }

    /**
     * Get the opciones for this pregunta.
     */
    public function respuestas(): HasMany
    {
        return $this->hasMany(Respuesta::class);
    }

    public function opciones(): HasMany
    {
        return $this->hasMany(Opcion::class);
    }

    public function subpreguntas(): HasMany
    {
        return $this->hasMany(Pregunta::class, 'depende_de');
    }

    public function padre(): BelongsTo
    {
        return $this->belongsTo(Pregunta::class, 'depende_de');
    }
}