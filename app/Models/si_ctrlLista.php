<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class si_ctrlLista extends Model
{
    protected $table = 'si_ctrl_lista';

    protected $primaryKey = 'id';

    protected $fillable = [
            'curp',
            'primer_apellido',
            'segundo_apellido',
            'nombre',
            'sexo',
            'cve_entidad_nacimiento',
            'cve_nacionalidad',
            'fecha_nacimiento',
            'edad',
            'estado_validado',
            'estado_verificado',
            'estado_termino',
            'estado_registro'

    ];

    public function preregistro(){
        return $this -> hasOne(si_prereg::class);
    }

    public function estudio(){
        return $this -> hasOne(si_reg_forms::class);
    }
    public function findbyCurp($curp){
        return $this -> where('curp', $curp)->first();
    }

    public $timestamps = true;
    public $incrementing = false;
}
