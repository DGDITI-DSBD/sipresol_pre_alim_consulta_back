<?php
namespace App\Models\Catalogos;

use Illuminate\Database\Eloquent\Model;


class PadronHistorico extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'padron_historico';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'curp',
        'primer_ap',
        'segundo_ap',
        'nombres',
        'fecha_nacimiento',
        'edad',
        'genero',
        'ct_ent_nac',
    ];
}