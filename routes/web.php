<?php

use app\Controllers\dashboard\MiembrosController;
use app\Controllers\dashboard\ParametrosController;
use app\Controllers\dashboard\UsuariosController;
use app\Controllers\test\TestController;
use app\Controllers\web\AuthController;
use app\Controllers\web\GuestController;
use app\Controllers\web\ProfileController;
use app\Controllers\web\WebController;
use app\Controllers\web\WellcomeController;
use lib\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar rutas web para tu aplicación. Estas
| rutas son cargadas por lib\Facades\Route.php y todas ellas pueden
| ser de tipo GET o POST y aceptan parametros utilizando el simbolo :
| seguido del nombre que va a tener dicho parametro. EJEMPLO

Route::get("/blog/:slug", function($slug){
    return 'hola mundo con parametro: '.$slug;
});

| Todas las rutas pueden llamar a un controlador. para ello se le pasa como
| segundo argumento un array con dos posiciones, la primera indicando la clase
| del controlador y la segunda indicando el metodo a ejecutar. EJEMPLO:

Route::get("home",[HomeController::class,'index']);

| La sistaxis es simple el primer argumento es la uri y el segundo una funcion
| calback o un controlador. ¡Haz algo genial!
*/


Route::get('/', [WellcomeController::class, 'index']);

//AUTH *************************************************************************************
Route::get('login/', [GuestController::class, 'login']);
Route::get('login/:type', [GuestController::class, 'login']);
Route::post('login', [AuthController::class, 'login']);

Route::get('register', [GuestController::class, 'register']);
Route::post('register', [AuthController::class, 'register']);

Route::get('forgot/password', [GuestController::class, 'forgotPassword']);
Route::post('forgot/password', [AuthController::class, 'forgotPassword']);

Route::get('reset/password', [GuestController::class, 'resetPassword']);
Route::post('reset/password', [AuthController::class, 'resetPassword']);
Route::get('reset/password/:token', [AuthController::class, 'resetPasswordEmail']);

Route::get('verify/email', [AuthController::class, 'validateEmail']);
Route::post('verify/email', [AuthController::class, 'reenviarEmail']);
Route::get('verify/email/:token', [AuthController::class, 'verifyEmail']);

Route::get('expired/token', [AuthController::class, 'expiredToken']);

Route::get('logout', [AuthController::class, 'logout']);

//TEST ******************************************************************************************

Route::get('test', [TestController::class, 'index']);
Route::post('test', [TestController::class, 'testGUMP']);

//DASHBOARD **************************************************************************************
Route::get('parametros', [ParametrosController::class, 'index']);
Route::post('parametros', [ParametrosController::class, 'save']);
Route::post('parametros/limit', [ParametrosController::class, 'limit']);
Route::post('parametros/refresh', [ParametrosController::class, 'refresh']);
Route::post('parametros/edit', [ParametrosController::class, 'update']);
Route::post('parametros/show', [ParametrosController::class, 'show']);
Route::post('parametros/destroy', [ParametrosController::class, 'destroy']);
Route::post('parametros/search', [ParametrosController::class, 'search']);

Route::get('miembros', [MiembrosController::class, 'index']);
Route::post('miembros', [MiembrosController::class, 'save']);
Route::post('miembros/limit', [MiembrosController::class, 'limit']);
Route::post('miembros/refresh', [MiembrosController::class, 'refresh']);
Route::post('miembros/edit', [MiembrosController::class, 'update']);
Route::post('miembros/show', [MiembrosController::class, 'show']);
Route::post('miembros/destroy', [MiembrosController::class, 'destroy']);
Route::post('miembros/search', [MiembrosController::class, 'search']);
Route::get('miembros/excel', [MiembrosController::class, 'exportExcel']);

Route::get('usuarios', [UsuariosController::class, 'index']);
Route::post('usuarios', [UsuariosController::class, 'save']);
Route::post('usuarios/limit', [UsuariosController::class, 'limit']);
Route::post('usuarios/refresh', [UsuariosController::class, 'refresh']);
Route::post('usuarios/edit', [UsuariosController::class, 'update']);
Route::post('usuarios/show', [UsuariosController::class, 'show']);
Route::post('usuarios/destroy', [UsuariosController::class, 'destroy']);
Route::post('usuarios/search', [UsuariosController::class, 'search']);


//WEB **********************************************************************************************
Route::get('web', [WebController::class, 'index']);
Route::get('membresia', [WebController::class, 'membresia']);
Route::post('membresia', [WebController::class, 'saveMembresia']);
Route::post('membresia/edit', [WebController::class, 'updateMembresia']);
Route::get('profile', [ProfileController::class, 'index']);
Route::post('profile/update', [ProfileController::class, 'update']);
Route::post('profile/update/password', [ProfileController::class, 'updatePassword']);



/*ruta temporal para probar vista de reset*/
Route::get('prueba', [AuthController::class, 'prueba']);

/*
| Esto debe estar siempre al final, ejecuta el enrutador y compara las rutas en el orden en
| que se definieron arriba, la primera que coincida se ejecuta, tener en cuenta con rutas con
| la misma uri. la comparacion es independiente al metodo
*/
Route::dispatch();
