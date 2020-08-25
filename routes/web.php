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
    Route::get('auditoria', 'MenuController@auditoria')->name('admin.auditoria');
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


//GRUPO DE RUTAS PARA LA GESTIÓN ACADÉMICA
Route::group(['middleware' => 'auth', 'prefix' => 'acadmico'], function () {
    Route::resource('periodosacademicos', 'PeriodoacademicoController');
    Route::get('periodosacademicos/{id}/delete', 'PeriodoacademicoController@destroy')->name('periodosacademicos.delete');

    Route::get('reporte/nivel-de-riesgo', 'ReporteAcademincoController@nivelesDeRiesgo')->name('reportes.niveles');

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
    //CRUD DE LOS PROGRAMAS DE APOYO
    Route::resource('programaapoyo', 'ProgramaapoyoController');
    Route::get('programaapoyo/{id}/delete', 'ProgramaapoyoController@destroy')->name('programaapoyo.delete');

//    //CRUD DE TALLERISTA
//    Route::resource('talleristas', 'TalleristaController');
//    Route::get('talleristas/{id}/delete', 'TalleristaController@destroy')->name('talleristas.delete');
//    Route::get('talleristas/{id}/disponibilidad', 'TalleristaController@disponibilidad')->name('talleristas.disponibilidad');
//
//    //DISPONIBILIDAD DOCENTES
//    Route::resource('docentes', 'DocenteController');
//    Route::get('get/{identificacion}/docente', 'DocenteController@getDocente')->name('docente.getdocente');
//    Route::put('docente/{id}/guardar_disponibilidad', 'DocenteController@guardarDisponibilidad')->name('docente.gurardar_disponibilidad');

});

//GRUPO DE RUTAS PARA EL MODULO DE ADMINISTRACIÓN
Route::group(['middleware' => 'auth', 'prefix' => 'administracion'], function () {
    //ADMINISTRACION
    Route::resource('administracion', 'AdministracionController');
    Route::get('administracion/{id}/delete', 'AdministracionController@destroy')->name('administracion.delete');
    //EMPLEADOS
    Route::resource('empleado', 'EmpleadoController');
    Route::get('empleado/{id}/delete', 'EmpleadoController@destroy')->name('empleado.delete');
});

//GRUPO DE RUTAS PARA EL MODULO DE PASTORAL
Route::group(['middleware' => 'auth', 'prefix' => 'pastoral'], function () {
    //PASTORALES
    Route::resource('pastorales', 'PastoralController');
    //Route::get('pastorales/{id}/delete', 'PastoralController@destroy')->name('pastorales.delete');
});
//GRUPO DE RUTAS PARA EL MODULO INTERVENCION
Route::group(['middleware' => 'auth', 'prefix' => 'intervencion'], function () {
    //INTERVENCIÓN INDIVIDUAL
    Route::resource('individualadmin', 'IntervencionindividualController');
    Route::get('individualadmin/{id}/delete', 'IntervencionindividualController@destroy')->name('individualadmin.delete');
    Route::get('individualadmin/get/{identificacion}/estudiante', 'IntervencionindividualController@getEstudiante')->name('individualadmin.getestudiante');
    Route::get('individualadmin/get/personal/{area}/{asignatura}', 'IntervencionindividualController@getPersonal')->name('individualadmin.getPersonal');
    Route::get('individualadmin/get/{persona}/disponibilidad', 'IntervencionindividualController@getDisponibilidad')->name('individualadmin.getDisponibilidad');
    Route::get('individualadmin/get/programas', 'IntervencionindividualController@getProgramas')->name('individual.getProgramas');
    Route::get('individualadmin/get/asignaturas/{area}', 'IntervencionindividualController@getAsignaturas')->name('individualadmin.getAsignaturas');
    Route::get('individualadmin/{intervension}/remitir', 'IntervencionindividualController@remision')->name('individualadmin.remision');
    Route::post('individualadmin/guardarremision', 'IntervencionindividualController@guardarRemision')->name('individualadmin.guardarRemision');

    //Route::get('remisiones', 'RemisionController@index')->name('remisiones.index');
    //TUTORIAS
    Route::resource('tutoria', 'TutoriaController');
    Route::get('tutoria/{id}/delete', 'TutoriaController@destroy')->name('tutoria.delete');
    Route::get('tutoria/get/{fecha}/remisiones', 'TutoriaController@getRemisiones')->name('tutoria.getRemisiones');
});


