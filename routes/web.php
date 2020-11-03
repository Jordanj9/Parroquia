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

Route::get('/home', 'HomeController@index')->name('home');
//cambiar contraseña
Route::get('usuarios/contrasenia/cambiar', 'UsuarioController@vistacontrasenia')->name('usuario.vistacontrasenia');
Route::post('usuarios/contrasenia/cambiar/finalizar', 'UsuarioController@cambiarcontrasenia')->name('usuario.cambiarcontrasenia');
Route::post('usuarios/contrasenia/cambiar/admin/finalizar', 'UsuarioController@cambiarPass')->name('usuario.cambiarPass');

//TODOS LOS MENUS
//GRUPO DE RUTAS PARA LA ADMINISTRACIÓN
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('usuarios', 'MenuController@usuarios')->name('admin.usuarios');
    Route::post('acceso', 'HomeController@confirmaRol')->name('rol');
    Route::get('inicio', 'HomeController@inicio')->name('inicio');
    Route::get('general', 'MenuController@general')->name('admin.general');
    Route::get('administracion', 'MenuController@administracion')->name('admin.administracion');
    Route::get('pastoral', 'MenuController@pastoral')->name('admin.pastoral');
    Route::get('reportes', 'MenuController@reportes')->name('admin.reportes');
    Route::get('auditoria', 'MenuController@auditoria')->name('admin.auditoria');
    //EVENTOS
    Route::resource('evento', 'EventoController');
    Route::get('evento/listar/get/eventos', 'EventoController@listar')->name('evento.listar');
    //NOTIFICACIONES
    Route::resource('notificaciones', 'NotificacionController');
});

//GRUPO DE RUTAS PARA LA ADMINISTRACIÓN DE USUARIOS
Route::group(['middleware' => 'auth', 'prefix' => 'usuarios'], function () {
    //MODULOS
    Route::resource('modulo', 'ModuloController');
    //PAGINAS O ITEMS DE LOS MODULOS
    Route::resource('pagina', 'PaginaController');
    //GRUPOS DE USUARIOS
    Route::resource('grupousuario', 'GrupousuarioController');
    Route::get('grupousuario/{id}/delete', 'GrupousuarioController@destroy')->name('grupousuario.delete');
    Route::get('privilegios', 'GrupousuarioController@privilegios')->name('grupousuario.privilegios');
    Route::get('grupousuario/{id}/privilegios', 'GrupousuarioController@getPrivilegios');
    Route::post('grupousuario/privilegios', 'GrupousuarioController@setPrivilegios')->name('grupousuario.guardar');
    //USUARIOS
    Route::resource('usuario', 'UsuarioController');
    Route::get('usuario/{id}/delete', 'UsuarioController@destroy')->name('usuario.delete');
    Route::post('operaciones', 'UsuarioController@operaciones')->name('usuario.operaciones');
    Route::post('usuario/contrasenia/cambiar/admin/finalizar', 'UsuarioController@cambiarPass')->name('usuario.cambiarPass');
});

//GRUPO DE RUTAS PARA EL MODULO GENERAL
Route::group(['middleware' => 'auth', 'prefix' => 'general'], function () {
    //PARROQUIA
    Route::resource('parroquia', 'ParroquiaController');
    Route::get('parroquia/{id}/delete', 'ParroquiaController@destroy')->name('parroquia.delete');
    //ESTADO CIVIL
    Route::resource('estadocivil', 'EstadocivilController');
    Route::get('estadocivil/{id}/delete', 'EstadocivilController@destroy')->name('estadocivil.delete');
    //SITUACION ESPIRITUAL
    Route::resource('situacionespiritual', 'SituacionespiritualController');
    Route::get('situacionespiritual/{id}/delete', 'SituacionespiritualController@destroy')->name('situacionespiritual.delete');
    //SACRAMENTOS
    Route::resource('sacramentos', 'SacramentoController');
    Route::get('sacramentos/{id}/delete', 'SacramentoController@destroy')->name('sacramentos.delete');
    //OCUPACIONES
    Route::resource('ocupacion', 'OcupacionController');
    Route::get('ocupacion/{id}/delete', 'OcupacionController@destroy')->name('ocupacion.delete');
});

//GRUPO DE RUTAS PARA EL MODULO DE ADMINISTRACIÓN
Route::group(['middleware' => 'auth', 'prefix' => 'administracion'], function () {
    //ADMINISTRACION
    Route::resource('administracion', 'AdministracionController');
    Route::get('administracion/{id}/delete', 'AdministracionController@destroy')->name('administracion.delete');
    //EMPLEADOS
    Route::resource('empleado', 'EmpleadoController');
    Route::get('empleado/{id}/delete', 'EmpleadoController@destroy')->name('empleado.delete');
    //CONSEJO PASTORAL
    Route::resource('consejopastoral', 'ConsejopastoralController');
    //CONSEJO ECONOMICO
    Route::resource('consejoeconomico', 'ConsejoeconomicoController');
});

//GRUPO DE RUTAS PARA EL MODULO DE PASTORAL
Route::group(['middleware' => 'auth', 'prefix' => 'pastoral'], function () {
    //PASTORALES
    Route::resource('pastorales', 'PastoralController');
    //SUBPASTORALES
    Route::resource('subpastoral', 'SubpastoralController');
    //COMUNIDAD
    Route::resource('comunidad', 'ComunidadController');
    Route::get('comunidad/get/{pastoral_id}/subpastorales', 'ComunidadController@getSubpastorales')->name('comunidad.getSubpastorales');
    Route::get('comunidad/quitar/lider/{comunidadlider_id}', 'ComunidadController@quitarLider')->name('comunidad.quitarlider');
    Route::get('comunidad/guardar/lider/{comunidad_id}/{tipo}/{nombre}/{ident}', 'ComunidadController@guardarLider')->name('comunidad.guardarLider');
    Route::get('comunidad/get/{id}/{modelo}/comunidades', 'ComunidadController@getComunidades')->name('comunidad.getComunidades');
    //MIEMBROS
    Route::resource('miembro', 'MiembroController');
    Route::post('miembro/guardar/ajax', 'MiembroController@store')->name('miembro.guardar');
    Route::get('miembro/get/{tipo_doc}/{identificacion}/consultar', 'MiembroController@getMiembro')->name('miembro.getMiembro');
    //PLAN PASTORAL
    Route::resource('planpastoral', 'PlanpastoralController');
});
//GRUPO DE RUTAS PARA EL MODULO DE REPORTES
Route::group(['middleware' => 'auth', 'prefix' => 'reportes'], function () {
    //MIEMBRO POR PASTORAL
    Route::get('miembro/pastoral/{pastoral_id}/{desde}/{hasta}/{pdf}/consultar', 'ReporteController@miembrosPastoral')->name('reportes.miembrospastoral');
    Route::get('miembro/pastoral/get/view', 'ReporteController@ViewMiembroPastoral')->name('reportes.ViewMiembroPastoral');
    Route::get('miembro/porcomunidad/get/', 'ReporteController@ViewMiembroComunidad')->name('reportes.viewmiembrocomunidad');
    Route::get('miembro/get/comunidad/{comunidad_id}/{desde}/{hasta}/{pdf}/consultar', 'ReporteController@miembrosComunidad')->name('reportes.miembroscomunidad');
    Route::get('miembro/porocupacion/get/', 'ReporteController@ViewMiembroOcupacion')->name('reportes.viewmiembroocupacion');
    Route::get('miembro/get/ocupacion/{ocupacion_id}/{pdf}/consultar', 'ReporteController@miembrosOcupacion')->name('reportes.miembrosocupacion');
    Route::get('miembro/get/', 'ReporteController@ViewMiembroGet')->name('reportes.viewmiembroget');
    Route::get('miembro/get/nombre/{nombre}/consultar', 'ReporteController@buscarMiembro')->name('reportes.buscarmiembro');

});



