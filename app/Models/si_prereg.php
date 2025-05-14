<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class si_prereg extends Model
{
    use HasFactory;

    protected $table = 'si_ctrl_prereg';

    protected $primaryKey = 'id';

    protected $fillable = [
        'si_ctrl_lista_id',
        'cve_tipo_id_ofl',
        'id_docto_ofl',
        'ct_edo_civil',
        'grupo_vuln_poblacion_atendida',
        'calle',
        'num_ext',
        'num_int',
        'entre_calle',
        'y_calle',
        'otra_referencia',
        'cve_asentamiento',
        'colonia',
        'cve_localidad',
        'localidad',
        'cve_municipio',
        'municipio',
        'cve_entidad_federativa',
        'entidad_federativa',
        'código_postal',
        'telefono',
        'telefono_fijo',
        'email',
        'cve_region',
        'fecha_registro',
        'fecha_solicitud'
    ];

    public function lista(){
        return $this -> belongsTo(si_ctrlLista::class);
    }


    public $timestamps = true;
    public $incrementing = true;

}
