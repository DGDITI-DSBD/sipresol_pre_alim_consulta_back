<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\oAuthController;
use App\Http\Controllers\oCatalogosController;
use App\Http\Controllers\oRegController;
use App\Http\Controllers\oRegEstudiosController;
use App\Http\Controllers\oConsultaEstadoController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('siprogem')->group(function(){

    //Validar CURP

  //  Route::post('auth/beneficiario', [oAuthController::class, 'verifiedBenef']);
  //  Route::post('auth/usuario', [oAuthController::class, 'logonAuthUser']);
  //  Route::get('checkCookie', [oAuthController::class, 'checkTokenCookie']);

    // BENEFICIARIOS
    
 //   Route::post('getFolio', [oAuthController::class, 'controlTokenFolio']);
   // Route::get('getBeneficiario', [oAuthController::class, 'index']);

    //DATOS GENERALES
    
    //Route::post('modificarGenerales', [oRegController::class, 'updateStatePreRegAccion']);

    //DATOS DOMICILIARIOS

   // Route::post('modificarDomicilio', [oRegController::class, 'updateStatePreRegDomAccion']);

    // ESTUDIO SOCIECONÓMICO

    //Route::post('modificarForms', [oRegEstudiosController::class, 'onUpdateFormMujeres']);

    // GENERAR DATOS PARA FORMATO FUB

    //Route::post('generar_fub', [oConsultaEstadoController::class, 'generarFub']);

    // CATÁLOGOS 

 //   Route::get('catalogos', [oCatalogosController::class, 'getInitCatalogos']);
//    Route::get('dominios', [oCatalogosController::class, 'dominios']);
//    Route::get('documentos', [oCatalogosController::class, 'documentos']);
//    Route::get('estado_civiles', [oCatalogosController::class, 'estados_civiles']);
//    Route::get('grado_estudios', [oCatalogosController::class, 'grado_estudios']);
//    Route::get('municipios', [oCatalogosController::class, 'municipios']);
//    Route::get('localidades', [oCatalogosController::class, 'localidades']);
//    Route::get('nacionalidades', [oCatalogosController::class, 'nacionalidades']);
//    Route::get('codigos_postales', [oCatalogosController::class, 'codigos_postales']);

    //FILTRO LOCALIDAD

//    Route::post('obLocalidad', [oCatalogosController::class, 'getFilterPerLocalidad']);

    //FILTRO COLONIAS

//    Route::post('obColonias', [oCatalogosController::class, 'getFilterPerColoniaAndPostal']);


    // Route::group(['middleware' => ['auth:sanctum', 'verified']], function(){



    // });

});

Route::get('catalogos', [oCatalogosController::class, 'getInitCatalogos']);


use App\Http\Controllers\Programa\ProgramaController;

Route::prefix('programas')->group(function () {
    Route::get('/', [ProgramaController::class, 'index']);
  //  Route::post('/', [ProgramaController::class, 'store']);
 //   Route::get('/{id}', [ProgramaController::class, 'show']);
 //   Route::put('/{id}', [ProgramaController::class, 'update']);
  //  Route::delete('/{id}', [ProgramaController::class, 'destroy']);
    
    Route::get('/{id}/apoyos', [ProgramaController::class, 'getApoyos']);
    Route::get('/{id}/calendarios', [ProgramaController::class, 'getCalendarios']);
});


use App\Http\Controllers\Programa\ApoyoController;

Route::prefix('apoyos')->group(function () {
    Route::get('/', [ApoyoController::class, 'index']);
  //  Route::post('/', [ApoyoController::class, 'store']);
 //   Route::get('/{id}', [ApoyoController::class, 'show']);
 //   Route::put('/{id}', [ApoyoController::class, 'update']);
 //   Route::delete('/{id}', [ApoyoController::class, 'destroy']);

    Route::get('/programa/{programaId}', [ApoyoController::class, 'getApoyosByPrograma']);

});

use App\Http\Controllers\Programa\CalendarioController;

Route::prefix('calendarios')->group(function () {
    Route::get('/', [CalendarioController::class, 'index']);
//    Route::post('/', [CalendarioController::class, 'store']);
//    Route::get('/{id}', [CalendarioController::class, 'show']);
//    Route::put('/{id}', [CalendarioController::class, 'update']);
//    Route::delete('/{id}', [CalendarioController::class, 'destroy']);
//    Route::get('/programa/{programaId}', [CalendarioController::class, 'getCalendariosByPrograma']);
    Route::get('/activos', [CalendarioController::class, 'getCalendariosActivos']);
});

// Preguntas
Route::prefix('preguntas')->group(function () {
    Route::get('/', 'App\Http\Controllers\Programa\PreguntaController@index');
    Route::post('/', 'App\Http\Controllers\Programa\PreguntaController@store');
    Route::get('/{id}', 'App\Http\Controllers\Programa\PreguntaController@show');
    Route::put('/{id}', 'App\Http\Controllers\Programa\PreguntaController@update');
 //   Route::delete('/{id}', 'App\Http\Controllers\Programa\PreguntaController@destroy');
    Route::get('/{id}/respuestas', 'App\Http\Controllers\Programa\PreguntaController@getRespuestas');
    Route::get('/programa/{programaId}', 'App\Http\Controllers\Programa\PreguntaController@getPreguntasByPrograma');
    Route::get('/programa/{programaId}/activas', 'App\Http\Controllers\Programa\PreguntaController@getPreguntasActivasByPrograma');
});

// Respuestas

Route::prefix('respuestas')->group(function () {
    Route::get('/', 'App\Http\Controllers\Programa\RespuestaController@index');
    Route::post('/', 'App\Http\Controllers\Programa\RespuestaController@store');
    Route::get('/{id}', 'App\Http\Controllers\Programa\RespuestaController@show');
    Route::put('/{id}', 'App\Http\Controllers\Programa\RespuestaController@update');
 //   Route::delete('/{id}', 'App\Http\Controllers\Programa\RespuestaController@destroy');
    Route::post('/{id}/restore', 'App\Http\Controllers\Programa\RespuestaController@restore');
    Route::get('/pregunta/{preguntaId}', 'App\Http\Controllers\Programa\RespuestaController@getRespuestasByPregunta');
});

//Registro

Route::prefix('registros')->group(function () {
//    Route::get('/', 'App\Http\Controllers\Registro\RegistroController@index');
    Route::post('/', 'App\Http\Controllers\Registro\RegistroController@store');
    Route::get('/id/{id}', 'App\Http\Controllers\Registro\RegistroController@show');
    Route::put('/{id}', 'App\Http\Controllers\Registro\RegistroController@update');
//    Route::delete('/{id}', 'App\Http\Controllers\Registro\RegistroController@destroy');
    Route::get('/folio/{folio}', 'App\Http\Controllers\Registro\RegistroController@buscarPorFolio');
    Route::patch('/{id}/estado', 'App\Http\Controllers\Registro\RegistroController@actualizarEstado');
    Route::patch('/{id}/beneficiario', 'App\Http\Controllers\Registro\RegistroController@actualizarBeneficiario');

    Route::post('/curp', 'App\Http\Controllers\Registro\RegistroController@verificarCurp');
    Route::get('/padron-historico/{curp}', 'App\Http\Controllers\Registro\RegistroController@buscarEnPadronHistorico');
    Route::get('/padron-activo/{curp}', 'App\Http\Controllers\Registro\RegistroController@buscarEnPadronActivo');

    Route::get('uuid/{uuid}', 'App\Http\Controllers\Registro\RegistroController@buscarPorUuid');
});

// Estudios
Route::prefix('estudios')->group(function () {
    Route::get('/', 'App\Http\Controllers\Registro\EstudioController@index');
    Route::post('/', 'App\Http\Controllers\Registro\EstudioController@store');
    Route::post('/bulk', 'App\Http\Controllers\Registro\EstudioController@storeBulk');
    Route::get('/{id}', 'App\Http\Controllers\Registro\EstudioController@show');
    Route::put('/{id}', 'App\Http\Controllers\Registro\EstudioController@update');
    Route::delete('/{id}', 'App\Http\Controllers\Registro\EstudioController@destroy');
    Route::get('/registro/{registroId}', 'App\Http\Controllers\Registro\EstudioController@getEstudiosByRegistro');
    Route::delete('/registro/{registroId}', 'App\Http\Controllers\Registro\EstudioController@deleteEstudiosByRegistro');
});

// Resultados
Route::prefix('resultados')->group(function () {
    Route::get('/', 'App\Http\Controllers\Registro\ResultadoController@index');
    Route::post('/', 'App\Http\Controllers\Registro\ResultadoController@store');
    Route::get('/{id}', 'App\Http\Controllers\Registro\ResultadoController@show');
    Route::put('/{id}', 'App\Http\Controllers\Registro\ResultadoController@update');
    Route::delete('/{id}', 'App\Http\Controllers\Registro\ResultadoController@destroy');
    Route::get('/registro/{registroId}', 'App\Http\Controllers\Registro\ResultadoController@getResultadoByRegistro');
    Route::post('/registro/{registroId}', 'App\Http\Controllers\Registro\ResultadoController@storeOrUpdateResultadoForRegistro');
});

// Cuestionario

Route::prefix('cuestionario')->group(function () {
    Route::get('/', 'App\Http\Controllers\Programa\CuestionarioController@index');
});

use App\Http\Controllers\Registro\EstudioController;

Route::post('/respuestas', [EstudioController::class, 'store']);
Route::get('/respuestas/registro/{registroId}', [EstudioController::class, 'show']);