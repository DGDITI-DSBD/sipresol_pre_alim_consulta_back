<?php

namespace App\Models\Programa;

use App\Models\Registro\Respuesta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Opcion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cat_opciones';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'texto',
        'valor',
    ];

        public function pregunta(): BelongsTo
        {
            return $this->belongsTo(Pregunta::class);
        }
    
        public function respuestas(): BelongsToMany
        {
            return $this->belongsToMany(Respuesta::class, 'respuestas_opciones')
                ->withPivot('cantidad')
                ->withTimestamps();
        }
}
