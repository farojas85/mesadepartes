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
Route::post('usuarios-restaurar','UserController@restaurar')->name('usuarios.restaurar');
Route::get('usuarios-modificar-contrasena','UserController@mdlCambiarContrasena')->name('usuarios.modificar-contrasena');
Route::post('usuarios-guardar-contrasena','UserController@guardarContrasena')->name('usuarios.guardar-contrasena');
Route::get('usuarios-perfil','UserController@perfilView')->name('usuarios.perfil');
Route::get('usuarios-subir-foto','UserController@mdlSubirFoto')->name('usuarios.subir-foto');
Route::post('usuarios-guardar-foto','UserController@guardarFoto')->name('usuarios.guardar-foto');
Route::get('perfil-editar-dato-personal','UserController@mdlEditarDatoPersonal')->name('usuarios.perfil-editar-dato-personal');
Route::get('perfil-editar-dato-usuario','UserController@mdlEditarDatoUsuario')->name('usuarios.perfil-editar-dato-usuario');
Route::get('perfil-mostrar-dato-personal','UserController@mdlMostrarDatoPersonal')->name('usuarios.perfil-mostrar-dato-personal');
Route::get('perfil-mostrar-dato-usuario','UserController@mdlMostrarDatoUsuario')->name('usuarios.perfil-mostrar-dato-usuario');
Route::post('perfil-actualizar-personal','UserController@actualizarDatoPersonal')->name('usuarios.actualizar-dato-personal');
Route::post('perfil-actualizar-usuario','UserController@actualizarDatoUsuario')->name('usuarios.actualizar-dato-usuario');

//RUTAS CONFIGURACION -ÁREAS
Route::post('areas-delete/{area}','AreaController@destroyTemporal')->name('areas.delete-temp');
Route::get('areas-habilitados','AreaController@habilitados')->name('areas.habilitados');
Route::get('areas-eliminados','AreaController@eliminados')->name('areas.eliminados');
Route::get('areas-todos','AreaController@todos')->name('areas.todos');
Route::post('areas-restaurar','AreaController@restaurar')->name('areas.restaurar');

//RUTAS CONFIGURACION -CARGO
Route::post('cargos-delete/{cargo}','CargoController@destroyTemporal')->name('cargos.delete-temp');
Route::get('cargos-habilitados','CargoController@habilitados')->name('cargos.habilitados');
Route::get('cargos-eliminados','CargoController@eliminados')->name('cargos.eliminados');
Route::get('cargos-todos','CargoController@todos')->name('cargos.todos');
Route::post('cargos-restaurar','CargoController@restaurar')->name('cargos.restaurar');

//RUTAS CONFIGURACION -TIPO DOCUMENTOS
Route::post('tipodocumentos-delete/{tipodocumento}','TipoDocumentoController@destroyTemporal')->name('tipodocumentos.delete-temp');
Route::get('tipodocumentos-habilitados','TipoDocumentoController@habilitados')->name('tipodocumentos.habilitados');
Route::get('tipodocumentos-eliminados','TipoDocumentoController@eliminados')->name('tipodocumentos.eliminados');
Route::get('tipodocumentos-todos','TipoDocumentoController@todos')->name('tipodocumentos.todos');
Route::post('tipodocumentos-restaurar','TipoDocumentoController@restaurar')->name('tipodocumentos.restaurar');

//RUTAS CONFIGURACIION - DOCUMENTO TRAMITES
Route::get('documento-tramites-todos','DocumentoTramiteController@todos')->name('documento-tramites.todos');
Route::get('documento-tramites-listar','DocumentoTramiteController@listar')->name('documento-tramites.listar');

//RUTAS TIPO TRAMITES
Route::get('tipo-tramite-listar','TramiteController@obtenerTipoTramitePorDocumentoTramite')->name('tipo-tramite.listar');
Route::get('tipo-tramite-todos','TipoTramiteController@todos')->name('tipo-tramite.todos');
