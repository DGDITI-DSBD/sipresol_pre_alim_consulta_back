<?php

namespace App\Models\Registro;

use App\Models\Registro\Registro;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Resultado extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'resultados_ponderacion_solicitudes';

    protected $primaryKey = 'id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'registro_id',
        'resultado',
        'observaciones'
    ];

    /**
     * Get the registro that owns the resultado.
     */
    public function registro()
    {
        return $this->belongsTo(Registro::class);
    }
}