<?php

use Illuminate\Support\Facades\Route;

//RUTAS ROLES
Route::post('roles-delete/{role}','RoleController@destroyTemporal')->name('roles.delete-temp');
Route::get('roles-habilitados','RoleController@habilitados')->name('roles.habilitados');
Route::get('roles-eliminados','RoleController@eliminados')->name('roles.eliminados');
Route::get('roles-todos','RoleController@todos')->name('roles.todos');
Route::post('roles-restaurar','RoleController@restaurar')->name('roles.restaurar');

//Rutas TIpo Documentos
Route::get('tipo-documentos-listado','TipoDocumentoController@listado')->name('tipo-documentos.listado');

//Rutas Usuarios
Route::get('usuario-verificar-documento','UserController@verificarDocumento')->name('usuarios.verificar-documento');
//RUTAS ROLES
Route::post('usuarios-delete/{usuario}','UserController@destroyTemporal')->name('usuarios.delete-temp');
Route::get('usuarios-habilitados','UserController@habilitados')->name('usuarios.habilitados');
Route::get('usuarios-eliminados','UserController@eliminados')->name('usuarios.eliminados');
Route::get('usuarios-todos','UserController@todos')->name('usuarios.todos');
Route::post('usuarios-restaurar','UsersController@restaurar')->name('usuarios.restaurar');
