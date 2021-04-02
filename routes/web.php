<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home','HomeController@index')->name('home');
    Route::get('/sistema','SistemaController@index')->name('sistema');
    Route::get('/configuracion','ConfiguracionController@index')->name('configuracion');

    Route::resource('roles', 'RoleController');
    Route::resource('usuarios', 'UserController');
    Route::resource('cargos', 'CargoController');
    Route::resource('tipodocumentos', 'TipoDocumentoController');
    Route::resource('areas', 'AreaController');
    Route::resource('documento-tramites','DocumentoTramiteController');
    Route::resource('tramite', 'TramiteController');
    Route::resource('tipo-tramite', 'TipoTramiteController');

    //Rutas Parciales
    require __DIR__.'/rutasParciales.php';
});
