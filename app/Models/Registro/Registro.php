<?php

namespace App\Models\Registro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use App\Models\Programa\Programa;
use App\Models\Registro\Respuesta;



class Registro extends Model
{

    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'registros';

    protected $primaryKey = 'id';

    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'programa_id',
        'apoyo_id',
        'calendario_id',
        'folio_solicitud',

        'fecha_solicitud',

        'estado_validacion_renapo',
        'fecha_validacion_renapo',
        'estado_solicitud',
        'estado_beneficiario',
        'cedis_id',
        'fecha_baja',
        'motivo_baja',

        //Metadato
        'folio_relacionado',
        'fecha_ingreso_programa',
        'primer_ap',
        'segundo_ap',
        'nombres',
        'fecha_nacimiento',
        'edad',
        'genero',
        'ct_edo_civil',
        'ct_escolaridad',
        'tp_id_oficial',
        'id_oficial',
        'ct_ent_nac',
        'curp',
        'calle',
        'num_ext',
        'num_int',
        'entre_calle',
        'y_calle',
        'otra_referencia',
        'colonia',
        'ct_localidad',
        'localidad',
        'ct_municipio',
        'municipio',
        'ct_entidad_federativa',
        'entidad_federativa',
        'codigo_postal_id',
        'codigo_postal',
        'telefono',
        'celular',
        'email',
        'uuid'
        
    ];

    /**
     * Get the programa that owns the registro.
     */
    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }

    /**
     * Get the estudio associated with the registro.
     */
    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }

    public function respuestasConSubpreguntas()
    {
        return $this->hasMany(Respuesta::class)
            ->with('subpreguntas')
            ->whereNull('respuesta_padre_id');
    }


    //Al crear un registro se debe generar un folio y un folio relacionado con una secuencia
    public static function boot()
    {
        parent::boot();
        // Generar folio y folio relacionado al crear un registro
        self::creating(function ($model) {
            DB::transaction(function () use ($model) {
            //Si el estado de solicitud es 100 se debe generar un folio relacionado si no no
            if ($model->estado_solicitud == 100) {
                $model->folio_solicitud = self::generarFolio($model);
                $model->folio_relacionado = self::generarFolioRelacionado($model,$model->folio_solicitud);
            }else{
                $model->folio_solicitud =  'PR-' . self::generarFolioPermanencia($model);
            }
            });
        });

        // Generate a UUID and assign it to the uuid column
        self::creating(function ($model) {
            $model->uuid = (string) \Illuminate\Support\Str::uuid();
        });
    }
    
    public static function generarFolio($model = null)
    {
        // Determine which sequence to use based on the program context
        $programa_id = isset($model) && isset($model->programa_id) ? $model->programa_id : null;
        
        if ($programa_id == 1) { // "hogar"
            $sequenceName = 'secuencia_folios_ab';
        }

        // Get the next value from the appropriate sequence
        $result = DB::selectOne("SELECT nextval('{$sequenceName}') as next_folio");
        $folio = $result->next_folio;
        return $folio;
    }

    public static function generarFolioPermanencia($model = null)
    {
        // Determine which sequence to use based on the program context
        $programa_id = isset($model) && isset($model->programa_id) ? $model->programa_id : null;
        
        if ($programa_id == 1) { // "hogar"
            $sequenceName = 'secuencia_folios_ab_permanencia';
        }

        // Get the next value from the appropriate sequence
        $result = DB::selectOne("SELECT nextval('{$sequenceName}') as next_folio");
        $folio = $result->next_folio;
        return $folio;
    }

    
    public static function generarFolioRelacionado($model = null, $result)
    {
        // Determine which sequence and prefix to use based on the program context
        // We need to access the current model instance
        $programa_id = isset($model) && isset($model->programa_id) ? $model->programa_id : null;
        
        $today = date('Y'); // Current year in "YYYY" format
        $prefix = "AB-N-{$today}-";

        $nextNumber = $result;

        // Format with leading zeros to ensure 7 digits
        $sequentialPart = str_pad($nextNumber, 7, '0', STR_PAD_LEFT);
        $folio = "{$prefix}{$sequentialPart}";
        return $folio;

        // Example result:
        // AB-N-2025-0000001 (for ALIMENTACION)
    }
    
}