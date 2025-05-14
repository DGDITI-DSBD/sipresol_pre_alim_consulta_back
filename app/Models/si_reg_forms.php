<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class si_reg_forms extends Model
{
    use HasFactory;

    protected $table = 'si_ctrl_estudio';

    protected $primaryKey = 'id';

    protected $fillable = [
            'si_ctrl_lista_id',
            'zona',
            'empleo_formal',
            'ingresos_mensuales',
            'seguro_social',
            'bnf_programa',
            'b_programa',
            'parentesco',
            'otro_parentesco',
            'casa',
            'cuartos', 
            'personas',
            'tipo_material_paredes',
            'servicios',
            'estudios', // binario
            'otro_estudio', //catalogo de grado de estudio
            'actual_estudio',
            'actual_otro_estudio',
            'falta_comida', // si - no // 3.14 En los ultimos tres meses, por falta de dinero o recursos ¿solo comió una vez, o dejó de comer todo un día?
            'jefa_familia',
            'afroamericana',
            'discapacidad',
            'victima',
            'indigena',
            'enfermedad',
            'cuida_personas',
            'repatriada',
            'situacion_pobreza',
    ];


    public function lista(){
        return $this -> belongsTo(si_ctrlLista::class);
    }



    public $incrementing = false;
    public $timestamps   = true;

}
