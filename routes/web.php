<?php

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

//Route::get('/script/{pu}/procesar', 'AcademicodocenteController@script');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/inscripcion/{nivel}/{servicio}/{proceso}/inscribirse', 'PublicController@index')->name('inscripcion.inscribirse');
Route::get('/inscripcion/{sp}/{nd}/validaraspirante', 'PublicController@validaraspirante')->name('inscripcion.validaraspirante');
Route::post('/inscripciones/finalizar', 'PublicController@store')->name('inscripcion.finalizar');
Route::post('/inscripciones/finalizar2', 'PublicController@store2')->name('inscripcion.finalizar2');
Route::get('/inscripciones/{id}/{sp}/imprimir', 'PublicController@imprimir')->name('imprimir');
Route::get('/inscripciones/{id}/{sp}/{pin}/{nivel}/{periodo}/{proceso}/inscripcion2', 'PublicController@inscripcion2')->name('inscripcion2');
Route::get('/inscripciones/{periodo}/{proceso}/{programa}/validarfechas', 'PublicController@validarfechas')->name('validarfechas');
Route::get('/paisp/{id}/estados', 'PaisController@estados')->name('paisp.estados');
Route::get('/estadop/{id}/ciudades', 'EstadoController@ciudades')->name('estadop.ciudades');
Route::get('/ciudadp/{id}/sectores', 'CiudadController@sectores')->name('ciudadp.sectores');
Route::get('/sectorp/{id}/barrios', 'SectorController@barrios')->name('sectorp.barrios');
Route::get('/iemp/{id}/instituciones', 'IemController@lista')->name('iemp.instituciones');
Route::get('/iesp/{id}/instituciones', 'IesController@lista')->name('iesp.instituciones');
Route::get('/pinp/{pin}/validarpin', 'PinController@validarPin')->name('pinp.validarpin');
Route::get('/convocatoriap/{mod}/{met}/{serp}/{und}/programas', 'ConvocatoriaController@programas')->name('convocatoriap.programas');
Route::get('/convocatoriap/{mod}/{met}/{und}/{per}/programasae', 'ConvocatoriaController@programasae')->name('convocatoriap.programasae');
Route::get('/convocatoriap/{mod}/{met}/{und}/{per}/programasconvabierta', 'ConvocatoriaController@programasconvabierta')->name('convocatoriap.programasconvabierta');
Route::get('/niveleducativop/{id}/modalidades', 'NivelEducativoController@getModalidades')->name('niveleducativop.modalidades');
Route::resource('/reserva', 'ReservaController');
Route::get('/reserva/{fecha}/indice', 'ReservaController@index')->name('reserva.indice');
Route::get('/reserva/{id}/getcliente', 'ReservaController@getCliente')->name('reserva.getcliente');
Route::get('/reserva/{tipo}/{fechainicio}/{fechafin}/{horainicio}/{horafin}/{tiporecurso}/getrecursos', 'ReservaController@getrecursos')->name('reserva.getrecursos');
Route::get('/reserva/{radicado}/seguimiento/consultar', 'ReservaController@seguimientoconsultar')->name('reserva.seguimientoconsultar');
Route::get('/reserva/{reserva}/seguimiento/consultar/liquidacion', 'ReservaController@seguimientoliquidar')->name('reserva.seguimientoliquidar');
Route::get('/reserva/{identificacion}/consultar/historico', 'ReservaController@historico')->name('reserva.historico');
//cambiar contraseña
Route::get('usuarios/contrasenia/cambiar', 'UsuarioController@vistacontrasenia')->name('usuario.vistacontrasenia');
Route::post('usuarios/contrasenia/cambiar/finalizar', 'UsuarioController@cambiarcontrasenia')->name('usuario.cambiarcontrasenia');
Route::post('usuarios/contrasenia/cambiar/admin/finalizar', 'UsuarioController@cambiarPass')->name('usuario.cambiarPass');

//TODOS LOS MENUS
//GRUPO DE RUTAS PARA LA ADMINISTRACIÓN
Route::group(['middleware' => ['auth', 'cors'], 'prefix' => 'admin'], function() {
    Route::get('academico', 'MenuController@academico')->name('admin.academico');
  //  Route::get('tesoreria/liquidacionmenu', 'MenuController@liquidacionmenu')->name('admin.liquidacionmenu');
   // Route::get('tesoreria/liquidacion/pecuniarios', 'MenuController@liquidacionpecuniarios')->name('admin.liquidacionpecuniarios');
   // Route::get('tesoreria', 'MenuController@tesoreria')->name('admin.tesoreria');
  //  Route::get('academicoestudiante', 'MenuController@academicoestudiante')->name('admin.academicoestudiante');
  //  Route::get('matricula', 'MenuController@matricula')->name('admin.matricula');
    Route::get('academicodocente', 'MenuController@academicodocente')->name('admin.academicodocente');
  //  Route::get('matriculadocente', 'MenuController@matriculadocente')->name('admin.matriculadocente');
  //  Route::get('financiera', 'MenuController@financiera')->name('admin.financiera');
  //  Route::get('unidades', 'MenuController@unidades')->name('admin.unidades');
    Route::get('cargos', 'MenuController@cargos')->name('admin.cargos');
    Route::get('usuarios', 'MenuController@usuarios')->name('admin.usuarios');
//    Route::get('programas/{id}/opciones', 'MenuController@programas')->name('admin.programas');
    Route::post('acceso', 'HomeController@confirmaRol')->name('rol');
    Route::get('inicio', 'HomeController@inicio')->name('inicio');
//    Route::get('admisiones', 'MenuController@admisiones')->name('admin.admisiones');
 //   Route::get('admisiones/inscribirse', 'MenuController@getInscribirse')->name('admin.admisiones.inscribirse');
 //   Route::get('instituciones', 'MenuController@instituciones')->name('admin.instituciones');
//    Route::get('calificaciones', 'MenuController@calificaciones')->name('admin.calificaciones');
//    Route::get('calificaciones/ingresoespecial', 'MenuController@ingresoespecial')->name('admin.ingresoespecial');
//    Route::get('calificaciones/sistemaevaluacion', 'MenuController@sistemaevaluacion')->name('admin.sistemaevaluacion');
//    Route::get('calificaciones/reglas', 'MenuController@reglas')->name('admin.reglas');
//    Route::get('calificaciones/fechas', 'MenuController@fechas')->name('admin.fechas');
    Route::get('docentes', 'MenuController@docentes')->name('admin.docentes');
//    Route::get('asignarpape', 'MenuController@asignarpape')->name('admin.asignarpape');
//    Route::get('matriculafinanciera', 'MenuController@matfinanciera')->name('admin.matriculafinanciera');
//    Route::get('basicoliquidaciones', 'MenuController@basicoliquidaciones')->name('admin.basicoliquidaciones');
 //   Route::get('demanda', 'MenuController@demanda')->name('admin.demanda');
//    Route::get('horario', 'MenuController@horario')->name('admin.horario');
//    Route::get('horario/horas', 'MenuController@horas')->name('admin.horas');
//    Route::get('matriculaacademica', 'MenuController@matacademica')->name('admin.matriculaacademica');
//    Route::get('matriculaacademicadb', 'MenuController@matacademicadb')->name('admin.matriculaacademicadb');
//    Route::get('sanciones', 'MenuController@sanciones')->name('admin.sanciones');
//    Route::get('sanciones/datosbasicos', 'MenuController@sancionesbasicos')->name('admin.sancionesbasicos');
//    Route::get('estimulos', 'MenuController@estimulos')->name('admin.estimulos');
//    Route::get('grados', 'MenuController@grados')->name('admin.grados');
//    Route::get('grados/jurados', 'MenuController@jurados')->name('admin.jurados');
//    Route::get('grados/asesores', 'MenuController@asesores')->name('admin.asesores');
//    Route::get('practicaempresarial', 'MenuController@practicaempresarial')->name('admin.practicaempresarial');
//    Route::get('practicaempresarial/datosbasicos', 'MenuController@practicaempresarialbasicos')->name('admin.practicaempresarialbasicos');
   Route::get('reportes', 'MenuController@reportes')->name('admin.reportes');
//    Route::get('repliquidaciones', 'MenuController@repliquidaciones')->name('admin.repliquidaciones');
//    Route::get('repproyectardemanda', 'MenuController@repproyectardemanda')->name('admin.repproyectardemanda');
//    Route::get('repmatacademica', 'MenuController@repmatacademica')->name('admin.repmatacademica');
//    Route::get('repcalificaciones', 'MenuController@repcalificaciones')->name('admin.repcalificaciones');
//    Route::get('repsanciones', 'MenuController@repsanciones')->name('admin.repsanciones');
//    Route::get('repestimulos', 'MenuController@repestimulos')->name('admin.repestimulos');
//    Route::get('repgrados', 'MenuController@repgrados')->name('admin.repgrados');
//    Route::get('repcargaadmin', 'MenuController@repcargaadmin')->name('admin.repcargaadmin');
    Route::get('repestructuracurricular', 'MenuController@repestructuracurricular')->name('admin.repestructuracurricular');
//    Route::get('reprecursosfisicos', 'MenuController@reprecursosfisicos')->name('admin.reprecursosfisicos');
//    Route::get('repdeudas', 'MenuController@repdeudas')->name('admin.repdeudas');
//    Route::get('rephorarios', 'MenuController@rephorarios')->name('admin.rephorarios');
//    Route::get('aulavirtual', 'MenuController@aulavirtual')->name('admin.aulavirtual');
//    Route::get('aulavirtualdoc', 'MenuController@aulavirtualdoc')->name('admin.aulavirtualdoc');
//    Route::get('aulavirtualest', 'MenuController@aulavirtualest')->name('admin.aulavirtualest');
//    Route::get('materias/{id}/menu', 'MenuController@materias')->name('admin.materias');
//    Route::get('pines/habilitarmenu', 'MenuController@habilitarmenu')->name('admin.habilitarmenu');
//    Route::get('reserva/recursos', 'MenuController@reservamenu')->name('admin.reservarecurso');
//    Route::get('menurecursos', 'MenuController@menurecursos')->name('admin.menurecursos');
//    Route::get('menumantenimiento', 'MenuController@menumantenimiento')->name('admin.menumantenimiento');
//    Route::get('menugestionreserva', 'MenuController@menugestionreserva')->name('admin.menugestionreserva');
//    Route::get('represerva', 'MenuController@represerva')->name('admin.represerva');
    Route::get('evaluacionautohetero', 'MenuController@evaluacionautohetero')->name('admin.evaluacionautohetero');
});


//GRUPO DE RUTAS PARA ACADÉMICO
Route::group(['middleware' => ['auth', 'cors'], 'prefix' => 'academico'], function() {
    //FACULTADES
    Route::resource('facultad', 'FacultadController');
    Route::get('facultad/{id}/delete', 'FacultadController@destroy')->name('facultad.delete');
    Route::get('facultad/{id}/get/departamentos', 'FacultadController@getDepartamentos')->name('facultad.getdepartamentos');
   //DEPARTAMENTOS
    Route::resource('departamentos', 'DepartamentoController');
    Route::get('departamentos/{id}/delete', 'DepartamentoController@destroy')->name('departamentos.delete');
   //TIPO PERIODO ACADEMICO
    Route::resource('tipoperiodo', 'TipoPeriodoController');
    Route::get('tipoperiodo/{id}/delete', 'TipoPeriodoController@destroy')->name('tipoperiodo.delete');
    Route::get('tipoperiodo/{id}/periodos', 'TipoPeriodoController@periodos')->name('tipoperiodo.periodos');
    //CARGOS
    Route::resource('cargo', 'CargoController');
    Route::get('cargo/{id}/delete', 'CargoController@destroy')->name('cargo.delete');
   //TIPO DE DOCUMENTO
    Route::resource('tipodoc', 'TipodocController');
    Route::get('tipodoc/{id}/delete', 'TipodocController@destroy')->name('tipodoc.delete');
   //PERSONAS NATURALES
    Route::resource('pnaturales', 'PnaturalesController');
    Route::get('pnaturales/{id}/delete', 'PnaturalesController@destroy')->name('pnaturales.delete');
    Route::get('pnaturales/{id}/personaNatural', 'PnaturalesController@personaNatural')->name('pnaturales.personaNatural');
    Route::get('pnaturales/{id}/personaNaturals', 'PnaturalesController@personaNatural2')->name('pnaturales.personaNaturals');
    //PERIODOS ACADÉMICOS
    Route::resource('periodoa', 'PeriodoacademicoController');
    Route::get('periodoa/{id}/delete', 'PeriodoacademicoController@destroy')->name('periodoa.delete');
    //DOCENTE
    Route::resource('docentes', 'DocentesController');
    Route::get('docentes/{id}/delete', 'DocentesController@destroy')->name('docentes.delete');
    Route::post('docentes/more', 'DocentesController@more')->name('docentes.more');
    //PROGRAMAR PERIODO ACADEMICO
    Route::resource('ppa', 'PpuController');
    Route::get('ppa/{id}/delete', 'PpuController@destroy')->name('ppa.delete');
    Route::get('ppa/{id}/more', 'PpuController@more')->name('ppa.more');
    Route::get('ppa/{id}/periodos', 'PpuController@periodos')->name('ppa.periodos');
    //PROGRAMAR PERIODO ACADEMICO
    Route::resource('periodoprogunidad', 'PeriodoprogunidadController');
    Route::get('periodoprogunidad/{pid}/{id}/delete', 'PeriodoprogunidadController@destroy')->name('periodoprogunidad.delete');
    Route::get('periodoprogunidad/{me_id}/{mo_id}/{un_id}/{pa_id}/programas', 'PeriodoprogunidadController@programas')->name('periodoprogunidad.programas');
});

//GRUPO DE RUTAS PARA LA ADMINISTRACIÓN DE USUARIOS
Route::group(['middleware' => ['auth', 'cors'], 'prefix' => 'usuarios'], function() {
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
    Route::get('automatico/estudiantes/vista', 'UsuarioController@vistaestudiante')->name('usuario.vistaestudiante');
    Route::post('usuarioconvertir/automatico', 'UsuarioController@convertir')->name('usuario.convertir');
    Route::get('automatico/docentes/vista', 'UsuarioController@vistadocente')->name('usuario.vistadocente');
    Route::post('usuarioconvertir/automatico/convertirdocentes', 'UsuarioController@convertirdocente')->name('usuario.convertirdocente');
});


//GRUPO DE RUTAS PARA ADMISIONES
Route::group(['middleware' => ['auth', 'cors'], 'prefix' => 'admisiones'], function() {
//    //PARAMETRIZAR FORMULARIO DE INSCRIPCION
//    Route::resource('pfi', 'PfiController');
//    Route::get('pfi/{id}/delete', 'PfiController@destroy')->name('pfi.delete');
//    Route::get('pfi/{panel}/{nivel}/elementos', 'PfiController@elementos')->name('pfi.elementos');
//    Route::get('pfi/{nivel}/parametros', 'PfiController@parametros')->name('pfi.parametros');
//    //PARAMETRIZAR FORMULARIO DE INSCRIPCION - DEFINIR CAMPOS PARA EL FORMULARIO
//    Route::resource('itemsf', 'ItemsfController');
//    Route::get('itemsf/{id}/delete', 'ItemsfController@destroy')->name('itemsf.delete');
//    Route::get('itemsf/{panel}/{nivel}/elementos', 'ItemsfController@elementos')->name('itemsf.elementos');
//    //GESTIÓN DE PINES
//    Route::resource('pin', 'PinController');
//    Route::get('pin/banco/usar', 'PinController@usarview')->name('pin.usarview');
//    Route::post('pin/banco/usar/guardar', 'PinController@usar')->name('pin.usar');
//    Route::post('pin/consultar', 'PinController@consultar')->name('pin.consultar');
//    Route::get('pin/banco/generar', 'PinController@banco')->name('pin.banco');
//    Route::post('pin/archivo', 'PinController@archivo')->name('pin.archivo');
//    Route::get('pin/{id}/delete', 'PinController@destroy')->name('pin.delete');
//    Route::get('pin/banco/cargar', 'PinController@vista_cargar')->name('pin.cargar');
//    Route::post('pin/banco/cargararchivo', 'PinController@cargar')->name('pin.cargararchivo');
//    Route::get('pin/banco/cargararchivo/{id}/verificar', 'PinController@verificar')->name('pin.verificar');
//    Route::get('pin/banco/cargararchivo/{id}/procesar', 'PinController@procesar')->name('pin.procesar');
//    Route::get('pin/banco/cargararchivo/{id}/delete', 'PinController@borrar')->name('pin.borrar');
//    Route::get('pin/habilitar/libres', 'PinController@habilitarlibres')->name('pin.habilitarlibres');
//    Route::post('pin/habilitar/libres/procesar', 'PinController@habilitarlibresp')->name('pin.habilitarlibresp');
//    Route::get('pin/habilitar/banco', 'PinController@habilitarbanco')->name('pin.habilitarbanco');
//    Route::post('pin/habilitar/banco/procesar', 'PinController@habilitarbancop')->name('pin.habilitarbancop');
//    //CONVOCATORIA DE INSCRIPCION
//    Route::resource('convocatoria', 'ConvocatoriaController');
//    Route::get('convocatoria/{id}/delete', 'ConvocatoriaController@destroy')->name('convocatoria.delete');
//    Route::post('convocatoria/crear', 'ConvocatoriaController@crear')->name('convocatoria.crear');
//    Route::get('convocatoria/{p_id}/{u_id}/listar', 'ConvocatoriaController@listar')->name('convocatoria.listar');
//    Route::get('convocatoria/{p_id}/{u_id}/{pr_id}/listarc', 'ConvocatoriaController@listarC')->name('convocatoria.listarc');
//    Route::get('convocatoria/{id}/estados', 'ConvocatoriaController@show')->name('convocatoria.estados');
//    Route::put('convocatoria/', 'ConvocatoriaController@change')->name('convocatoria.change');
//    //DATOS DE CIRCUNSCRIPCION
//    Route::resource('circunscripcion', 'CircunscripcionController');
//    Route::get('circunscripcion/{id}/delete', 'CircunscripcionController@destroy')->name('circunscripcion.delete');
//    //GESTIONAR DATOS DE INSCRITOS
//    Route::resource('datosinscritos', 'DatosinscritosController');
//    Route::get('datosinscritos/{ne}/{sp}/aspirantes', 'DatosinscritosController@aspirantes')->name('datosinscritos.aspirantes');
//    Route::get('datosinscritos/{aspirante}/{sp}/menuaspirante', 'DatosinscritosController@menuaspirante')->name('datosinscritos.menuaspirante');
//    Route::get('datosinscritos/{aspirante}/{sp}/menumaspirante', 'DatosinscritosController@menumaspirante')->name('datosinscritos.menumaspirante');
//    Route::get('datosinscritos/{aspirante}/{sp}/menuaaspirante', 'DatosinscritosController@menuaaspirante')->name('datosinscritos.menuaaspirante');
//    Route::get('datosinscritos/{aspirante}/{sp}/editaspi', 'DatosinscritosController@editaspi')->name('datosinscritos.editaspi');
//    Route::put('datosinscritos/updateaspi/{aspirante}', 'DatosinscritosController@updateaspi')->name('datosinscritos.updateaspi');
//    Route::get('datosinscritos/{aspirante}/{sp}/editestsec', 'DatosinscritosController@editestsec')->name('datosinscritos.editestsec');
//    Route::put('datosinscritos/updateestsec/{aspirante}', 'DatosinscritosController@updateestsec')->name('datosinscritos.updateestsec');
//    Route::get('datosinscritos/{aspirante}/{sp}/editinstde', 'DatosinscritosController@editinstde')->name('datosinscritos.editinstde');
//    Route::post('datosinscritos/updateinstde/', 'DatosinscritosController@updateinstde')->name('datosinscritos.updateinstde');
//    Route::get('datosinscritos/{aspirante}/{sp}/{id}/deleteinstde', 'DatosinscritosController@deleteinstde')->name('datosinscritos.deleteinstde');
//    Route::get('datosinscritos/{aspirante}/{sp}/editestp', 'DatosinscritosController@editestp')->name('datosinscritos.editestp');
//    Route::post('datosinscritos/updateestp/', 'DatosinscritosController@updateestp')->name('datosinscritos.updateestp');
//    Route::get('datosinscritos/{aspirante}/{sp}/{id}/deleteestp', 'DatosinscritosController@deleteestp')->name('datosinscritos.deleteestp');
//    Route::get('datosinscritos/{aspirante}/{sp}/editestpo', 'DatosinscritosController@editestpo')->name('datosinscritos.editestpo');
//    Route::post('datosinscritos/updateestpo/', 'DatosinscritosController@updateestpo')->name('datosinscritos.updateestpo');
//    Route::get('datosinscritos/{aspirante}/{sp}/{id}/deleteestpo', 'DatosinscritosController@deleteestpo')->name('datosinscritos.deleteestpo');
//    Route::get('datosinscritos/{aspirante}/{sp}/editcr', 'DatosinscritosController@editcr')->name('datosinscritos.editcr');
//    Route::post('datosinscritos/updatecr/', 'DatosinscritosController@updatecr')->name('datosinscritos.updatecr');
//    Route::get('datosinscritos/{aspirante}/{sp}/{id}/deletecr', 'DatosinscritosController@deletecr')->name('datosinscritos.deletecr');
//    Route::get('datosinscritos/{aspirante}/{sp}/editpub', 'DatosinscritosController@editpub')->name('datosinscritos.editpub');
//    Route::post('datosinscritos/updatepub/', 'DatosinscritosController@updatepub')->name('datosinscritos.updatepub');
//    Route::get('datosinscritos/{aspirante}/{sp}/{id}/deletpub', 'DatosinscritosController@deletepub')->name('datosinscritos.deletepub');
//    Route::get('datosinscritos/{aspirante}/{sp}/editgf', 'DatosinscritosController@editgf')->name('datosinscritos.editgf');
//    Route::post('datosinscritos/updategf/', 'DatosinscritosController@updategf')->name('datosinscritos.updategf');
//    Route::get('datosinscritos/{aspirante}/{sp}/{id}/deletgf', 'DatosinscritosController@deletegf')->name('datosinscritos.deletegf');
//    Route::get('datosinscritos/{aspirante}/{sp}/editise', 'DatosinscritosController@editise')->name('datosinscritos.editise');
//    Route::put('datosinscritos/updateise/{aspirante}', 'DatosinscritosController@updateise')->name('datosinscritos.updateise');
//    Route::get('datosinscritos/{aspirante}/{sp}/editposr', 'DatosinscritosController@editposr')->name('datosinscritos.editposr');
//    Route::put('datosinscritos/updateposr/{aspirante}', 'DatosinscritosController@updateposr')->name('datosinscritos.updateposr');
//    Route::get('datosinscritos/{aspirante}/{sp}/editjf', 'DatosinscritosController@editjf')->name('datosinscritos.editjf');
//    Route::post('datosinscritos/updatejf/', 'DatosinscritosController@updatejf')->name('datosinscritos.updatejf');
//    Route::get('datosinscritos/{aspirante}/{sp}/{id}/deletjf', 'DatosinscritosController@deletejf')->name('datosinscritos.deletejf');
//    Route::get('datosinscritos/{aspirante}/{sp}/editidiomas', 'DatosinscritosController@editidiomas')->name('datosinscritos.editidiomas');
//    Route::post('datosinscritos/updateidiomas/', 'DatosinscritosController@updateidiomas')->name('datosinscritos.updateidiomas');
//    Route::get('datosinscritos/{aspirante}/{sp}/{id}/deleteidiomas', 'DatosinscritosController@deleteidiomas')->name('datosinscritos.deleteidiomas');
//    Route::get('datosinscritos/{aspirante}/{sp}/editpasa', 'DatosinscritosController@editpasa')->name('datosinscritos.editpasa');
//    Route::post('datosinscritos/updatepasa/', 'DatosinscritosController@updatepasa')->name('datosinscritos.updatepasa');
//    Route::get('datosinscritos/{aspirante}/{sp}/{id}/deletepasa', 'DatosinscritosController@deletepasa')->name('datosinscritos.deletepasa');
//    Route::get('datosinscritos/{form}/{motivo}/anularform', 'DatosinscritosController@anularform')->name('datosinscritos.anularform');
//    Route::get('datosinscritos/{form}/activarform', 'DatosinscritosController@activarform')->name('datosinscritos.activarform');
//    Route::get('datosinscritos/{form}/{sp}/show', 'DatosinscritosController@show')->name('datosinscritos.show');
//    Route::get('datosinscritos/{form}/{sp}/edit', 'DatosinscritosController@edit')->name('datosinscritos.edit');
//    Route::get('datosinscritos/{form}/{prog}/{sp}/cp', 'DatosinscritosController@cp')->name('datosinscritos.cp');
//    Route::get('datosinscritos/{form}/{sp}/{pxfid}/eliminarpxf', 'DatosinscritosController@eliminarpxf')->name('datosinscritos.eliminarpxf');
//    Route::get('datosinscritos/agregar/aspirante/', 'DatosinscritosController@agregaraspirante')->name('datosinscritos.agregaraspirante');
//    Route::get('datosinscritos/aspirantes/nuevos/admitidos/{id}/{ne}/{sp}/listar', 'DatosinscritosController@getAdmitidos')->name('datosinscritos.getadmitidosl');
//    //INSCRITOS POR PROGRAMAS
//    Route::resource('inscritosxprograma', 'InscritosxprogramaController');
//    Route::get('inscritosxprograma/{ne}/{sp}/{pu}/aspirantes', 'InscritosxprogramaController@aspirantes')->name('inscritosxprograma.aspirantes');
//    //PAGAR TRANSFERENCIAS Y REINTEGROS
//    Route::resource('pagartyr', 'PagartyrController');
//    //JORNADAS DE ADMISIÓN
//    Route::resource('jornadaadmision', 'JornadaadmisionController');
//    Route::get('jornadaadmision/{id}/delete', 'JornadaadmisionController@destroy')->name('jornadaadmision.delete');
//    //GESTIONAR PRUEBAS DE ADMISIÓN
//    Route::resource('pruebasadmision', 'PruebasadmisionController');
//    //PARAMETRIZAR DOCUMENTOS ANEXOS
//    Route::resource('parametrizardocsanexos', 'ParametrizardocsanexosController');
//    Route::get('parametrizardocsanexos/{obligatorio}/{tipodocanexo_id}/{circunscricion_id}/{programa_id}/guardar', 'ParametrizardocsanexosController@store')->name('parametrizardocsanexos.guardar');
//    Route::get('parametrizardocsanexos/{programa_id}/{circunscripcion_id}/getdocs', 'ParametrizardocsanexosController@getDocumentos')->name('parametrizardocsanexos.getdocs');
//    Route::get('parametrizardocsanexos/{id}/delete', 'ParametrizardocsanexosController@destroy')->name('parametrizardocsanexos.delete');
//    //MEDIOS DE DIVULGACIÓN
//    Route::resource('mediosdivulgacion', 'MediosdivulgacionController');
//    Route::get('mediosdivulgacion/{id}/delete', 'MediosdivulgacionController@destroy')->name('mediosdivulgacion.delete');
//    //SITUACION EN TIPOS DE INSCRIPCION
//    Route::resource('situaciontipoinscripcion', 'SituaciontipoinscripcionController');
//    Route::get('situaciontipoinscripcion/{id}/delete', 'SituaciontipoinscripcionController@destroy')->name('situaciontipoinscripcion.delete');
//    Route::get('situaciontipoinscripcion/{id}/{id_ti}/guardar', 'SituaciontipoinscripcionController@store')->name('situaciontipoinscripcion.guardar');
//    Route::get('situaciontipoinscripcion/{id_ti}/getsituaciones', 'SituaciontipoinscripcionController@getSituaciones')->name('situaciontipoinscripcion.getsituaciones');
//    //ECAES
//    Route::resource('ecaes', 'EcaesController');
//    Route::get('ecaes/{id}/delete', 'EcaesController@destroy')->name('ecaes.delete');
//    Route::get('ecaes/{id}/listar', 'EcaesController@indexarea')->name('ecaes.listar');
//    Route::get('ecaes/{id}/crear', 'EcaesController@createa')->name('ecaes.crear');
//    Route::post('ecaes/area/guardar', 'EcaesController@almacenar')->name('ecaes.guardar');
//    Route::get('ecaes/{id}/editar', 'EcaesController@edita')->name('ecaes.editar');
//    Route::put('ecaes/change/{area}', 'EcaesController@updatea')->name('ecaes.change');
//    Route::get('ecaes/{id}/deletea', 'EcaesController@destroya')->name('ecaes.deletea');
//    //TIPOS DE DISCAPACIDAD
//    Route::resource('tipodiscapacidad', 'TipodiscapacidadController');
//    Route::get('tipodiscapacidad/{id}/delete', 'TipodiscapacidadController@destroy')->name('tipodiscapacidad.delete');
//    //CRITERIOS DE SELECCION
//    Route::resource('criteriosseleccion', 'CriteriosseleccionController');
//    Route::get('criteriosseleccion/{id}/delete', 'CriteriosseleccionController@destroy')->name('criteriosseleccion.delete');
//    //CRITERIOS DE SELECCION POR PROGRAMA
//    Route::resource('criteriosseleccionprograma', 'CriteriosseleccionprogramaController');
//    Route::get('criteriosseleccionprograma/{id}/delete', 'CriteriosseleccionprogramaController@destroy')->name('criteriosseleccionprograma.delete');
//    //COMPONENTES EXAMEN DE ADMISION
//    Route::resource('componentesexamenadmision', 'ComponentesexamenadmisionController');
//    Route::get('componentesexamenadmision/{id}/delete', 'ComponentesexamenadmisionController@destroy')->name('componentesexamenadmision.delete');
//    //DATOS DE AREAS PRUEBAS DE ESTADO
//    Route::resource('datosape', 'DatosapeController');
//    Route::get('datosape/{id}/delete', 'DatosapeController@destroy')->name('datosape.delete');
//    Route::get('datosape/{id_tp}/getareas', 'DatosapeController@getareas')->name('datosape.getareas');
//    //OBTENER LISTA SNP
//    Route::resource('listasnp', 'ListasnpController');
//    Route::get('listasnp/{id}/delete', 'ListasnpController@destroy')->name('listasnp.delete');
//    //CARGAR ARCHIVO CON LOS RESULTADOS DEL ICFES
//    Route::resource('archivoresulticfes', 'ArchivoresulticfesController');
//    //CARGAR ARCHIVO CON LOS RESULTADOS DE LAS PRUEBAS DE ADMISION
//    Route::resource('archivoresultadmision', 'ArchivoresultadmisionController');
//    //PARAMETRIZAR SELECCION
//    Route::resource('parametrizarseleccion', 'ParametrizarseleccionController');
//    //PARAMETRIZAR CALIFICACION PRUEBAS DE ESTADO
//    Route::resource('parametrizarpe', 'ParametrizarpeController');
//    //GESTIONAR CRITERIOS DE DESEMEPATE
//    Route::resource('gcriteriosdesempate', 'GcriteriosdesempateController');
//    //CALIFICAR ASPIRANTES
//    Route::resource('calificaraspirantes', 'CalificaraspirantesController');
//    Route::get('calificaraspirantes/{form}/{pr}/{aspi}/{pxf}/aspirante', 'CalificaraspirantesController@lista')->name('calificaraspirantes.list');
//    Route::get('calificaraspirantes/{pxf}/{cal}/{area}/guardarcal', 'CalificaraspirantesController@guardarcal')->name('calificaraspirantes.guardarcal');
//    Route::get('calificaraspirantes/{pxf}/{pu}/{tp}/{form}/{aspi}/calificar', 'CalificaraspirantesController@calificar')->name('calificaraspirantes.calificar');
//    //SELECCIONAR ESTUDIANTES NUEVOS
//    Route::resource('seleccionarestudiantesnuevos', 'SeleccionarestudiantesnuevosController');
//    Route::get('seleccionarestudiantesnuevos/aspirantes/index', 'SeleccionarestudiantesnuevosController@index2')->name('seleccionarestudiantesnuevos.aspirantes');
//    Route::get('seleccionarestudiantesnuevos/aspirantes/convertir/index', 'SeleccionarestudiantesnuevosController@index3')->name('seleccionarestudiantesnuevos.convertir');
//    Route::get('seleccionarestudiantesnuevos/aspirantes/convertir/aspirantes', 'SeleccionarestudiantesnuevosController@index4')->name('seleccionarestudiantesnuevos.aspirantes2');
//    Route::post('seleccionarestudiantesnuevos/aspirantes/convertir/aspirantes/procesar', 'SeleccionarestudiantesnuevosController@store2')->name('seleccionarestudiantesnuevos.store2');
//    Route::post('seleccionarestudiantesnuevos/transferencias/convertir/externas/procesar', 'SeleccionarestudiantesnuevosController@store3')->name('seleccionarestudiantesnuevos.store3');
//    Route::post('seleccionarestudiantesnuevos/transferencias/convertir/internas/procesar/internas', 'SeleccionarestudiantesnuevosController@store4')->name('seleccionarestudiantesnuevos.store4');
//    //GESTIONAR DATOS DE LLAMADOS
//    Route::resource('datosllamados', 'DatosllamadosController');
//    Route::post('datosllamados/continuar', 'DatosllamadosController@continuar')->name('datosllamados.continuar');
//    Route::get('datosllamados/{id}/listar', 'DatosllamadosController@listar')->name('datosllamados.listar');
//    Route::post('datosllamados/guardarLlamado', 'DatosllamadosController@guardar')->name('datosllamados.guardar');
//    Route::post('datosllamados/admitidos', 'DatosllamadosController@admitidos')->name('datosllamados.admitidos');
//    Route::get('datosllamados/{unidad}/{periodo}/{programa}/noadmitidos', 'DatosllamadosController@cargarNoAdmitidos')->name('datosllamados.noadmitidos');
//    Route::get('datosllamados/{unidad}/{periodo}/{programa}/siadmitidos', 'DatosllamadosController@cargarAdmitidos')->name('datosllamados.siadmitidos');
//    Route::post('datosllamados/admitir', 'DatosllamadosController@admitir')->name('datosllamados.admitir');
//    Route::get('datosllamados/admitir/{conv}/{form}/noadmitir', 'DatosllamadosController@noadmitir')->name('datosllamados.noadmitir');
//    //GENERACION MASIVA DE LLAMADOS
//    Route::resource('gmasivallamados', 'GmasivallamadosController');
//    //REGISTRO MASIVO DE ADMITIDOS
//    Route::resource('regmasivoadmitidos', 'RegmasivoadmitidosController');
//    //ELIMINAR ADMITIDOS SIN LIQUIDACION PAGA
//    Route::resource('eliminaradmtsinpago', 'EliminaradmtsinpagoController');
//    //RANGOS DE SALARIOS
//    Route::resource('rangosalario', 'RangosalarioController');
//    Route::get('rangosalario/{id}/delete', 'RangosalarioController@destroy')->name('rangosalario.delete');
//    //OCUPACIONES LABORALES
//    Route::resource('ocupacionlaboral', 'OcupacionlaboralController');
//    Route::get('ocupacionlaboral/{id}/delete', 'OcupacionlaboralController@destroy')->name('ocupacionlaboral.delete');
//    //TIPOS DE DOCUMENTOS ANEXOS ADMISIONES//
//    Route::resource('tipodocanexob', 'TipodocanexobController');
//    Route::get('tipodocanexob/{id}/delete', 'TipodocanexobController@destroy')->name('tipodocanexob.delete');
//    //DEFINIR PESO DE AREAS ICFES POR PROGRAMAS
//    Route::resource('pesoareaicfesxprograma', 'PesoareaicfesxprogramaController');
//    Route::get('pesoareaicfesxprograma/{peso}/{areaicfe_id}/{programa_id}/{tp}/guardar', 'PesoareaicfesxprogramaController@store')->name('Pesoareaicfesxprograma.guardar');
//    Route::get('pesoareaicfesxprograma/{programa_id}/{tipoprueba}/getareas', 'PesoareaicfesxprogramaController@getAreas')->name('Pesoareaicfesxprograma.getareas');
//    Route::get('pesoareaicfesxprograma/{id}/delete', 'PesoareaicfesxprogramaController@destroy')->name('Pesoareaicfesxprograma.delete');
//    //REGISTRAR ASPIRANTE PARA TRANSFERENCIA EXTERNA, REALIZAR TRANSFERENCIA EXTERNA E INTERNA
//    Route::get('inscripcion/{nivel}/aspirante/trasferenciaexterna', 'PublicController@agregaraspte')->name('inscripcion.agregaraspte');
//    Route::post('inscripcion/aspirante/trasferenciaexterna/finalizar', 'PublicController@storeasptranse')->name('inscripcion.storeasptranse');
//    Route::get('inscripcion/{nivel}/aspirante/trasferenciaexterna/solicitudtransferencia', 'TransferenciaController@solicitudtransferencia')->name('inscripcion.solicitudtransferencia');
//    Route::get('inscripcion/{nivel}/aspirante/trasferenciaexterna/solicitudtransferencia/{td}/{doc}/buscar', 'TransferenciaController@buscaraspirante')->name('inscripcion.buscaraspirante');
//    Route::resource('transferencia', 'TransferenciaController');
//    Route::get('inscripcion/{nivel}/aspirante/transferenciainterna/solicitudtransferencia', 'TransferenciaController@solicitudtransferenciainterna')->name('inscripcion.solicitudtransferenciainterna');
//    Route::get('inscripcion/{nivel}/aspirante/transferenciainterna/solicitudtransferencia/{ep}/continuar', 'TransferenciaController@solicitudtransferenciainterna2')->name('inscripcion.solicitudtransferenciainterna2');
//    Route::post('inscripcion/aspirante/transferenciainterna/solicitudtransferencia/informacionfinanciera/guardar', 'TransferenciaController@tiguardarinfofinanciera')->name('inscripcion.tiguardarinfofinanciera');
//    Route::get('inscripcion/{nivel}/aspirante/transferenciainterna/solicitudtransferencia/{ep}/continuar2', 'TransferenciaController@solicitudtransferenciainterna3')->name('inscripcion.solicitudtransferenciainterna3');
//    Route::post('transferencia/finalizar/store2', 'TransferenciaController@store2')->name('transferencia.store2');
//    Route::get('transferencia/externa/admisiones', 'TransferenciaController@admisionexterna')->name('transferencia.admisionexterna');
//    Route::get('transferencia/externa/admisiones/{unidad}/{periodo}/{serviciop}/{programaunidad}/aspirantes', 'TransferenciaController@admisionexternaaspirantes')->name('transferencia.admisionexternaaspirantes');
//    Route::get('transferencia/externa/admisiones/{trans}/admitir', 'TransferenciaController@admisionexternaadmitir')->name('transferencia.admisionexternaadmitir');
//    Route::post('transferencia/externa/admisiones/admitir/procesar', 'TransferenciaController@admisionexternaadmitirprocesar')->name('transferencia.admisionexternaadmitirprocesar');
//    Route::get('transferencia/interna/admisiones2', 'TransferenciaController@admisioninterna')->name('transferencia.admisioninterna');
//    Route::get('transferencia/interna/admisiones/{unidad}/{periodo}/{serviciop}/{programaunidad}/aspirantesti', 'TransferenciaController@admisionexternaaspirantesti')->name('transferencia.admisionexternaaspirantesti');
//    Route::get('transferencia/interna/admisiones/{trans}/admitir', 'TransferenciaController@admisioninternaadmitir')->name('transferencia.admisioninternaadmitir');
//    Route::get('transferencia/interna/admisiones/{trans}/admitirget', 'TransferenciaController@admisioninternaadmitirget')->name('transferencia.admisioninternaadmitirget');
//    Route::post('transferencia/interna/admisiones/admitir/procesar', 'TransferenciaController@admisioninternaadmitirprocesar')->name('transferencia.admisioninternaadmitirprocesar');
//    Route::get('transferencia/externa/admitidos/{id}/{ne}/{sp}/{und}/listar', 'TransferenciaController@getAdmitidoste')->name('transferencia.getadmitidoste');
//    Route::get('transferencia/externa/conversiones/convertir', 'TransferenciaController@admisionexterna2')->name('transferencia.admisionexterna2');
//    Route::get('transferencia/interna/conversiones/convertir/interna', 'TransferenciaController@admisioninterna2')->name('transferencia.admisioninterna2');
//    Route::get('transferencia/interna/admitidos/{id}/{sp}/{und}/listar', 'TransferenciaController@getAdmitidosti')->name('transferencia.getadmitidosti');
});


//GRUPO DE RUTAS PARA LOS REPORTES
Route::group(['middleware' => ['auth', 'cors'], 'prefix' => 'reportes'], function() {
    //ADMISIONES
    Route::resource('admisiones', 'RepadmisionesController');
    Route::get('admisiones/{u}/{p}/{met}/{mod}/{n}/menu', 'RepadmisionesController@menu')->name('admisiones.menu');
    Route::get('admisiones/{u}/{p}/{met}/{mod}/{n}/menu/inscritosxprograma', 'RepadmisionesController@inscritosxprograma')->name('admisiones.inscritosxprograma');
    Route::get('admisiones/{und}/{per}/{met}/{mod}/{ne}/{p}/{e}/{o}/{ec}/menu/inscritosxprograma/pdf', 'RepadmisionesController@inscritosxprograma_pdf');
    Route::get('admisiones/{und}/{per}/{met}/{mod}/{ne}/{p}/{e}/{o}/{ec}/menu/inscritosxprograma/excel', 'RepadmisionesController@inscritosxprograma_excel');
    Route::get('admisiones/{u}/{p}/{met}/{mod}/{n}/menu/transferenciaexterna', 'RepadmisionesController@transferenciaexterna')->name('admisiones.transferenciaexterna');
    Route::get('admisiones/{und}/{per}/{met}/{mod}/{ne}/{p}/{o}/menu/transferenciaexterna/pdf', 'RepadmisionesController@transferenciaexterna_pdf');
    Route::get('admisiones/{u}/{p}/{met}/{mod}/{n}/menu/cuposxcircunscripcion', 'RepadmisionesController@cuposxcircunscripcion')->name('admisiones.cuposxcircunscripcion');
    Route::get('admisiones/{und}/{met}/{mod}/{ne}/{p}/{ec}/menu/cuposxcircunscripcion/pdf', 'RepadmisionesController@cuposxcircunscripcion_pdf');
    Route::get('admisiones/{und}/{met}/{mod}/{ne}/{p}/{ec}/menu/cuposxcircunscripcion/excel', 'RepadmisionesController@cuposxcircunscripcion_excel');
    Route::get('admisiones/{u}/{p}/{met}/{mod}/{n}/menu/transferenciainterna', 'RepadmisionesController@transferenciainterna')->name('admisiones.transferenciainterna');
    Route::get('admisiones/{und}/{per}/{met}/{mod}/{ne}/{p}/{o}/menu/transferenciainterna/pdf', 'RepadmisionesController@transferenciainterna_pdf');
    Route::get('admisiones/{u}/{p}/{met}/{mod}/{n}/menu/puntajeobtenidoxaspirante', 'RepadmisionesController@puntajeobtenidoxaspirante')->name('admisiones.puntajeobtenidoxaspirante');
    Route::get('admisiones/{und}/{per}/{met}/{mod}/{ne}/{p}/{o}/menu/puntajeobtenidoxaspirante/pdf', 'RepadmisionesController@puntajeobtenidoxaspirante_pdf');
    Route::get('admisiones/{und}/{per}/{met}/{mod}/{ne}/{p}/{o}/menu/puntajeobtenidoxaspirante/excel', 'RepadmisionesController@puntajeobtenidoxaspirante_excel');
    Route::get('admisiones/{u}/{p}/{met}/{mod}/{n}/menu/listadoinscritonuevoicfes/pdf', 'RepadmisionesController@listadoinscritonuevoicfes_pdf')->name('admisiones.listadoinscritonuevoicfes');
    Route::get('admisiones/{u}/{p}/{met}/{mod}/{n}/menu/cuposperiodos/pdf', 'RepadmisionesController@cuposperiodos_pdf')->name('admisiones.cuposperiodos');
    Route::get('admisiones/{u}/{p}/{met}/{mod}/{n}/menu/inscritosxfecha', 'RepadmisionesController@inscritosxfecha')->name('admisiones.inscritosxfecha');
    Route::get('admisiones/{und}/{per}/{met}/{mod}/{ne}/{fi}/{ff}/menu/inscritosxfecha/pdf', 'RepadmisionesController@inscritosxfecha_pdf');
    Route::get('admisiones/{und}/{per}/{met}/{mod}/{ne}/{fi}/{ff}/menu/inscritosxfecha/excel/reporte', 'RepadmisionesController@inscritosxfecha_excel');
    Route::get('admisiones/{u}/{p}/{met}/{mod}/{n}/menu/formulariosinprograma', 'RepadmisionesController@formulariosinprograma')->name('admisiones.formulariosinprograma');
    Route::get('admisiones/{und}/{per}/{met}/{mod}/{ne}/{fi}/{ff}/menu/formulariosinprograma/pdf', 'RepadmisionesController@formulariosinprograma_pdf');
    Route::get('admisiones/{und}/{per}/{met}/{mod}/{ne}/{fi}/{ff}/menu/formulariosinprograma/excel', 'RepadmisionesController@formulariosinprograma_excel');
    Route::get('admisiones/{u}/{p}/{met}/{mod}/{n}/menu/admitidosxtipoadmision', 'RepadmisionesController@admitidosxtipoadmision')->name('admisiones.admitidosxtipoadmision');
    Route::get('admisiones/{und}/{per}/{met}/{mod}/{ne}/{p}/{tipo}/menu/admitidosxtipoadmision/pdf', 'RepadmisionesController@admitidosxtipoadmision_pdf');
    Route::get('admisiones/{und}/{per}/{met}/{mod}/{ne}/{p}/{tipo}/menu/admitidosxtipoadmision/excel', 'RepadmisionesController@admitidosxtipoadmision_excel');
    Route::get('admisiones/{u}/{p}/{met}/{mod}/{n}/menu/inscritosxprograma/numericos', 'RepadmisionesController@inscritosxprograma_numericos')->name('admisiones.inscritosxprogramanumericos');
    Route::get('admisiones/{und}/{per}/{met}/{mod}/{ne}/{p}/{e}/{o}/{ec}/menu/inscritosxprograma/numericos/pdf', 'RepadmisionesController@inscritosxprograma_numericos_pdf');
    Route::get('admisiones/{und}/{per}/{met}/{mod}/{ne}/{p}/{e}/{o}/{ec}/menu/inscritosxprograma/numericos/excel', 'RepadmisionesController@inscritosxprograma_numericos_excel');
    
    
});


//GRUPO DE RUTAS PARA LOS ESTUDIANTES
Route::group(['middleware' => ['auth', 'cors'], 'prefix' => 'estudiante'], function() {
//    //HOJA DE VIDA ESTUDIANTE
//    Route::resource('hojavidaestudianteest', 'HojavidaestudianteestController');
//    Route::get('hojavidaestudianteest/{ep}/menu/estudiosecundario', 'HojavidaestudianteestController@estudiosecundario')->name('hojavidaestudianteest.estudiosecundario');
//    Route::get('hojavidaestudianteest/{ep}/menu/estudiopregrado', 'HojavidaestudianteestController@estudiopregrado')->name('hojavidaestudianteest.estudiopregrado');
//    Route::get('hojavidaestudianteest/{ep}/menu/estudioposgrado', 'HojavidaestudianteestController@estudioposgrado')->name('hojavidaestudianteest.estudioposgrado');
//    Route::get('hojavidaestudianteest/{ep}/menu/experienciadocente', 'HojavidaestudianteestController@experienciadocente')->name('hojavidaestudianteest.experienciadocente');
//    Route::get('hojavidaestudianteest/{ep}/menu/experienciainvestigacion', 'HojavidaestudianteestController@experienciainvestigacion')->name('hojavidaestudianteest.experienciainvestigacion');
//    Route::get('hojavidaestudianteest/{ep}/menu/pasatiempos', 'HojavidaestudianteestController@pasatiempos')->name('hojavidaestudianteest.pasatiempos');
//    Route::get('hojavidaestudianteest/{ep}/menu/publicaciones', 'HojavidaestudianteestController@publicaciones')->name('hojavidaestudianteest.publicaciones');
//    Route::get('hojavidaestudianteest/{ep}/menu/cursosrealizados', 'HojavidaestudianteestController@cursosrealizados')->name('hojavidaestudianteest.cursosrealizados');
//    Route::get('hojavidaestudianteest/{ep}/menu/idiomas', 'HojavidaestudianteestController@idiomas')->name('hojavidaestudianteest.idiomas');
//    Route::get('hojavidaestudianteest/{ep}/menu/asociacioncientifica', 'HojavidaestudianteestController@asociacioncientifica')->name('hojavidaestudianteest.asociacioncientifica');
//    Route::get('hojavidaestudianteest/{ep}/menu/referencias', 'HojavidaestudianteestController@referencias')->name('hojavidaestudianteest.referencias');
//    Route::get('hojavidaestudianteest/{ep}/menu/datospersonales', 'HojavidaestudianteestController@datospersonales')->name('hojavidaestudianteest.datospersonales');
//    //CONSULTAR PENSUM
//    Route::get('pensum/consultarpensum', 'PensummateriaController@vistaestudiantepensum')->name('pm.vistaestudiantepensum');
//    Route::get('pensum/{ep}/consultar/pensum', 'PensummateriaController@vistaestudiantepensumconsultar')->name('pm.vistaestudiantepensumconsultar');
//    //REALIZAR MATRICULA EN LINEA
//    Route::get('matriculae/enlinea', 'MatriculaestudiantesController@enlinea')->name('matriculae.enlinea');
//    Route::get('matriculae/enlinea/{ep}/periodosestudiante', 'MatriculaestudiantesController@periodosestudiante')->name('matriculae.periodosestudiante');
//    Route::get('matriculae/enlinea/{ep}/{periodo}/verificarfechas', 'MatriculaestudiantesController@verificarfechas')->name('matriculae.verificarfechas');
//    Route::get('matriculae/enlinea/{ep}/{periodo}/realizar/matricula/enlinea', 'MatriculaestudiantesController@menumatricula')->name('matriculae.menumatricula');
//    Route::get('matriculae/enlinea/{ep}/{periodo}/{gr}/realizar/matricula/enlinea/eliminar', 'MatriculaestudiantesController@eliminarmateria')->name('matriculae.eliminarmateria');
//    Route::get('matriculae/enlinea/{ep}/{periodo}/realizar/matricula/enlinea/menumatricular', 'MatriculaestudiantesController@menumatricular')->name('matriculae.menumatricular');
//    Route::get('matriculae/enlinea/realizar/matricula/enlinea/menumatricular/{grupo}/verhorariogrupo', 'MatriculaestudiantesController@verhorariogrupo')->name('matriculae.verhorariogrupo');
//    Route::get('matriculae/enlinea/{ep}/{periodo}/{gr}/realizar/matricula/enlinea/menumatricular/matricular', 'MatriculaestudiantesController@matricular')->name('matriculae.matricular');
//    Route::get('matriculae/enlinea/{ep}/{periodo}/{mat}/realizar/matricula/enlinea/menumatricular/horario', 'MatriculaestudiantesController@horarioestudiante')->name('matriculae.horario');
//    Route::get('matriculae/enlinea/{ep}/{periodo}/{gr}/realizar/matricula/enlinea/menumatricular/cambiar/grupo', 'MatriculaestudiantesController@cambiargrupo')->name('matriculae.cambiargrupo');
//    Route::get('matriculae/enlinea/{ep}/{periodo}/{mat}/{gr}/{gm}/realizar/matricula/enlinea/menumatricular/cambiar/grupo/cambiar', 'MatriculaestudiantesController@cambiargrupocambiar')->name('matriculae.cambiargrupocambiar');
//    Route::get('matriculae/enlinea/{ep}/{periodo}/{mat}/realizar/matricula/enlinea/menumatricular/horario/imprimir', 'MatriculaestudiantesController@imprimirhorarioestudiante')->name('matriculae.imprimirhorario');
//    //HORARIO ESTUDIANTE
//    Route::get('matriculae/consultarhorario', 'MatriculaestudiantesController@consultarhorario')->name('matriculae.consultarhorario');
//    Route::get('matriculae/consultarhorario/{ep}/{per}/imprimir', 'MatriculaestudiantesController@consultarhorarioi')->name('matriculae.consultarhorarioi');
//    //CONSULTAR MATRICULA ACADEMICA
//    Route::get('matriculae/consultarmatricula/academica', 'MatriculaestudiantesController@consultarmatricula')->name('matriculae.consultarmatricula');
//    Route::get('matriculae/consultar/{ep}/{per}/matricula/academica', 'MatriculaestudiantesController@consultarmatriculaacademica')->name('matriculae.consultarmatriculaacademica');
//    //INCLUIR MATERIA
//    //Route::get('matriculae/enlinea/{ep}/{periodo}/realizar/matricula/enlinea/menumatricular', 'MatriculaestudiantesController@menumatricular')->name('matriculae.menumatricular');
//    //CONSULTAR LIQUIDACION ESTUDIANTE
//    Route::get('liquidacion/estudiante/consultar', 'FinancieraestudianteController@consultarliquidacion')->name('liquidacione.consultarliquidacion');
//    Route::get('liquidacion/estudiante/{ep}/{per}/consultar', 'FinancieraestudianteController@consultarl')->name('liquidacione.consultarliquidacionl');
//    //DEUDAS
//    Route::get('deudas/estudiante/consultar', 'FinancieraestudianteController@deudas')->name('deudase.consultard');
//    Route::get('deudas/estudiante/{ep}/consultar', 'FinancieraestudianteController@deudaslistar')->name('deudase.consultardeudas');
//    //CANCELAR MATERIA
//    Route::get('matriculae/cancelarmateria/inicio', 'MatriculaestudiantesController@cancelarmateriainicio')->name('matriculae.cancelarmateriainicio');
//    Route::get('matriculae/cancelarmateria/inicio/{ep}/{periodo}/verificarfechas', 'MatriculaestudiantesController@verificarfechascancelar')->name('matriculae.verificarfechascancelar');
//    Route::get('matriculae/cancelarmateria/inicio/{ep}/{periodo}/matriculaacademica', 'MatriculaestudiantesController@matriculaacademicacm')->name('matriculae.matriculaacademicacm');
//    Route::get('matriculae/cancelarmateria/inicio/{ep}/{per}/{tc}/{oc}/{id}/cancelar', 'MatriculaestudiantesController@cancelarmateriac')->name('matriculae.cancelarmateriac');
//    //ADICIONAR MATERIA (INCLUIR MATERIA)
//    Route::get('matriculae/adicionarmateria/inicio', 'MatriculaestudiantesController@adicionarmateriainicio')->name('matriculae.adicionarmateriainicio');
//    Route::get('matriculae/cancelarmateria/inicio/{ep}/{periodo}/verificarfechas', 'MatriculaestudiantesController@verificarfechascancelar')->name('matriculae.verificarfechascancelar');
//    Route::get('matriculae/adicionarmateria/inicio/{ep}/{periodo}/matriculaacademica', 'MatriculaestudiantesController@matriculaacademicaam')->name('matriculae.matriculaacademicaam');
//    Route::get('matriculae/adicionarmateria/inicio/{ep}/{periodo}/matriculaacademica/adicionarmenu', 'MatriculaestudiantesController@menumatricularam')->name('matriculae.menumatricularam');
//    Route::get('matriculae/adicionarmateria/inicio/{ep}/{periodo}/{gr}/{mat}/matriculaacademica/adicionarmenu/matricular', 'MatriculaestudiantesController@matricularam')->name('matriculae.matricularam');
//    Route::get('matriculae/adicionarmateria/inicio/{ep}/{periodo}/{mat}/matriculaacademica/adicionarmenu/horario', 'MatriculaestudiantesController@horarioepa')->name('matriculae.horarioepa');
//    //DEMANDA DE MATERIAS
//    Route::get('demanda/estudiante/materias', 'MatriculaestudiantesController@demandaest')->name('matriculae.demandaest');
//    Route::get('demanda/estudiante/{ep}/materias/get', 'MatriculaestudiantesController@demandaestget')->name('matriculae.demandaestget');
//    //CALIFICACIONES
//    Route::get('academico/calificaciones/menu', 'AcademicostudianteController@menu')->name('academicoest.menu');
//    Route::get('academico/calificaciones/menu/{ep}/{tipo}/{per}/consultarnotas', 'AcademicostudianteController@consultarnotas')->name('academicoest.consultarnotas');
//    Route::get('academico/calificaciones/menu/{ep}/consultarnotas/extendidoimprimir', 'AcademicostudianteController@extendidoimprimir')->name('academicoest.extendidoimprimir');
//    Route::get('academico/calificaciones/menu/{gm}/{per}/consultarnotas/actuales/materia', 'AcademicostudianteController@consultarnotasactuales')->name('academicoest.consultarnotasactuales');
});

//GRUPO DE RUTAS PARA LOS DOCENTES
Route::group(['middleware' => ['auth', 'cors'], 'prefix' => 'docente'], function() {
//    //DATOS PERSONALES
//    Route::get('datospersonales/{doc}/consultar', 'AcademicodocenteController@datospersonales')->name('datospersonales.index');
//    //LISTADO DE ESTUDIANTES POR GRUPOS
//    Route::get('listadoestudiantes/{per}/porgrupo', 'AcademicodocenteController@listarestudiantes')->name('listadoestudiantes.index');
//    Route::get('listadoestudiantes/{per}/{grupo}/porgrupo/pdf', 'AcademicodocenteController@listarestudiantespdf')->name('listadoestudiantes.pdf');
//    //CARGA ACADÉMICA DEL DOCENTE
//    Route::get('cargacademica/{per}/docente', 'MatriculadocenteController@cargaadacemica')->name('cargaadacemica.index');
//    //HORARIO DOCENTE
//    Route::get('horario/{per}/docente', 'MatriculadocenteController@horario')->name('horario.index');
//    //CALIFICACIONES DOCENTE
//    Route::get('calificaciones/{per}/grupos', 'CalificacionesdocenteController@listargrupos')->name('calificacionesdocente.listargrupos');
//    Route::get('calificaciones/{per}/grupos/{gr}/vistacalificar', 'CalificacionesdocenteController@vistacalificar')->name('calificacionesdocente.vistacalificar');
//    Route::get('calificaciones/{e}/{gr}/{per}/listarestudiantes', 'CalificacionesdocenteController@listarestudiantes')->name('calificacionesdocente.listarestudiantes');
//    Route::get('calificaciones/{idcal}/{estado}/{just}/{nota}/{fallas}/listarestudiantes/calificar', 'CalificacionesdocenteController@calificar')->name('calificacionesdocente.calificar');
//    Route::post('calificaciones/listarestudiantes/calificar/masivo/post', 'CalificacionesdocenteController@calificarMasivo')->name('calificacionesdocente.calificarMasivo');
//    //HABILITACION
//    Route::get('calificaciones/{per}/grupos/{gr}/vistahabilitar', 'CalificacionesdocenteController@vistahabilitar')->name('calificacionesdocente.vistahabilitar');
//    Route::get('calificaciones/{idgm}/{estado}/{nota}/{eval}/listarestudiantes/habilitar', 'CalificacionesdocenteController@habilitar')->name('calificacionesdocente.habilitar');
//    //VER CALIFICACIONES
//    Route::get('calificaciones/{gr}/{per}/listarestudiantes/calificaciones/ver', 'CalificacionesdocenteController@listarestudiantesver')->name('calificacionesdocente.listarestudiantesver');
//    Route::get('calificaciones/{gr}/{per}/listarestudiantes/calificaciones/pdf', 'CalificacionesdocenteController@listarestudiantesimprimir')->name('calificacionesdocente.listarestudiantesimprimir');
//    //IMPRIMIR PLANILLA CALIFICACIONES
//    Route::get('calificaciones/{gr}/{per}/listarestudiantes/calificaciones/planilla/pdf', 'CalificacionesdocenteController@planilla')->name('calificacionesdocente.planilla');
});




//GRUPO DE RUTAS PARA LAS EVALUACIONES ACADÉMICAS
Route::group(['middleware' => ['auth', 'cors'], 'prefix' => 'evaluacionacademica'], function() {
    //CRITERIOS DE EVALUACIÓN
    Route::resource('criterioe', 'CriterioevaluacionController');
    Route::get('criterioe/{id}/delete', 'CriterioevaluacionController@destroy')->name('criterioe.delete');
    //INDICADORES
    Route::resource('indicador', 'IndicadorController');
    Route::get('indicador/{id}/delete', 'IndicadorController@destroy')->name('indicador.delete');
    //VALORACION
    Route::resource('valoracion', 'ValoracionevaluacionacademicaController');
    Route::get('valoracion/{id}/delete', 'ValoracionevaluacionacademicaController@destroy')->name('valoracion.delete');
    //FORMULARIOS DE EVALUACIÓN ACADÉMICA
    Route::resource('evaluacionaah', 'EvaluacionaahController');
    Route::get('evaluacionaah/{id}/delete', 'EvaluacionaahController@destroy')->name('evaluacionaah.delete');
    Route::get('evaluacionaah/{id}/indicadores/index', 'EvaluacionaahController@indicadores')->name('evaluacionaah.indicadores');
    Route::get('evaluacionaah/{id}/indicadores/{idi}/delete', 'EvaluacionaahController@indicadordelete')->name('evaluacionaah.indicadordelete');
    Route::get('evaluacionaah/{id}/indicadores/{idi}/agregar/indicador', 'EvaluacionaahController@indicadoragregar')->name('evaluacionaah.indicadoragregar');
    //JEFE DEPARTAMENTO
    Route::resource('jefedepartamento', 'JefedepartamentoController');
    Route::get('jefedepartamento/{id}/delete', 'JefedepartamentoController@destroy')->name('jefedepartamento.delete');
    //FECHA EVALUACION ACADEMICA
    Route::resource('fechaaplicacion', 'FechaaplicacionevaluacionController');
    Route::get('fechaaplicacion/{id}/delete', 'FechaaplicacionevaluacionController@destroy')->name('fechaaplicacion.delete');
    //AUTORIZAR EVALUACION
    Route::resource('autorizarevaluacion', 'AutorizarevaluacionController');
    Route::get('autorizarevaluacion/{id}/delete', 'AutorizarevaluacionController@destroy')->name('autorizarevaluacion.delete');
    Route::get('autorizarevaluacion/{e}/{p}/{r}/agregar', 'AutorizarevaluacionController@agregar')->name('autorizarevaluacion.agregar');
    //APLICAR EVALUACION ESTUDIANTE
    Route::get('aplicacionestudiante/inicio', 'AplicarevaluacionController@estudianteindex')->name('aplicacionestudiante.inicio');
    Route::get('aplicacionestudiante/inicio/{ep}/{per}/matricula/academica', 'AplicarevaluacionController@consultarmatriculaacademica')->name('aplicacionestudiante.consultarmatriculaacademica');
    Route::get('aplicacionestudiante/inicio/{ep}/{per}/matricula/academica/{pn}/{doc}/{materia}/aplicar', 'AplicarevaluacionController@vistaaplicarestudiante')->name('aplicacionestudiante.vistaaplicarestudiante');
    Route::post('aplicacionestudiante/inicio/matricula/academica/aplicar/enviar', 'AplicarevaluacionController@guardarevaluacionestudiante')->name('aplicacionestudiante.guardarevaluacionestudiante');
    //APLICACION JEFE DE DEPARTAMENTO
    Route::get('aplicacionjefe/inicio', 'AplicarevaluacionController@jefeindex')->name('aplicacionjefe.inicio');
    Route::get('aplicacionjefe/inicio/{periodo}/{jefedepartamento}/ir', 'AplicarevaluacionController@jefeconsutarfecha')->name('aplicacionjefe.ir');
    Route::get('aplicacionjefe/inicio/{pensum}/{periodo}/{programa}/{jefe}/getdocentes', 'AplicarevaluacionController@getDocentes')->name('aplicacionjefe.getdocentes');
    Route::get('aplicacionjefe/{docente_pege}/{doncetepn}/{materia}/{jefedepto}/{programa}/{periodo}/continuar', 'AplicarevaluacionController@continuar')->name('aplicacionjefe.continuar');
    Route::post('aplicacionjefe/inicio/evaluacion/academica/aplicar/enviar', 'AplicarevaluacionController@guardarevaluacionjefe')->name('aplicacionjefe.guardarevaluacionjefe');
    //APLICACION DOCENTE
    Route::get('aplicaciondocente/inicio', 'AplicarevaluacionController@docenteindex')->name('aplicaciondocente.inicio');
    Route::get('aplicaciondocente/inicio/{periodo}/{dq}/{da}/{ev}/ir', 'AplicarevaluacionController@docenteconsutarfecha')->name('aplicaciondocente.ir');
    Route::get('aplicaciondocente/{docenteacademico}/{unidad}/{periodo}/{materia}/continuar', 'AplicarevaluacionController@continuardoc')->name('aplicaciondocente.continuar');
    Route::post('aplicaciondocente/inicio/autoevaluacion/academica/enviar', 'AplicarevaluacionController@guardarevaluaciondocente')->name('aplicaciondocente.guardarevaluaciondocente');
    //RESULTADOS EVALUACION ACADEMICA
    Route::get('resultadosea/index', 'ResultadoseaController@resultadoseaindex')->name('resultadosea.inicio');
    Route::get('resultadosea/index/{per}/docentes', 'DocentesController@getDocentesPeriodo')->name('resultadosea.docentes');
    Route::get('resultadosea/index/{pro}/{per}/docentes', 'ResultadoseaController@getDocentes')->name('resultadosea.docentes2');
    Route::get('resultadosea/index/{docente}/{per}/mostrarresultados/individual', 'ResultadoseaController@docenteIndividual')->name('resultadosea.docenteindividual');
    Route::get('resultadosea/index/{docente}/{per}/mostrarresultados/individual/pdf', 'ResultadoseaController@docenteIndividualpdf')->name('resultadosea.docenteindividualpdf');
    Route::get('resultadosea/index/{docente}/{per}/{programa}/{unidad}/mostrarresultados/programa', 'ResultadoseaController@docentePrograma')->name('resultadosea.docenteprograma');
    Route::get('resultadosea/index/{docente}/{per}/{programa}/{unidad}/mostrarresultados/programa/pdf', 'ResultadoseaController@docenteProgramapdf')->name('resultadosea.docenteprogramapdf');
    Route::get('resultadosea/index/docentes/index', 'ResultadoseaController@resultadosdocenteindex')->name('resultadosea.resultadosdocenteindex');
    Route::get('resultadosea/index/docentes/index/{periodo}/resultados', 'ResultadoseaController@resultadosdocenteresultados')->name('resultadosea.resultadosdocenteresultados');
    Route::get('resultadosea/index/docentes/index/{periodo}/resultados/{eval}/{doc}/detalles', 'ResultadoseaController@resultadosdocenteresultadosc')->name('resultadosea.resultadosdocenteresultadosc');
    Route::get('resultadosea/index/admin/index/{periodo}/resultados/{eval}/{doc}/detalles', 'ResultadoseaController@resultadosdocenteresultadosca')->name('resultadosea.resultadosdocenteresultadosca');
    Route::get('resultadosea/index/admin/index/{periodo}/resultados/{eval}/{doc}/{pro}/detalles', 'ResultadoseaController@resultadosdocenteresultadoscap')->name('resultadosea.resultadosdocenteresultadoscap');
    //CONFIGURACION DE DOCENTES
    Route::resource('docenteexamen', 'DocenteexamenController');
    Route::get('docenteexamen/{id}/delete', 'DocenteexamenController@destroy')->name('docenteexamen.delete');
    Route::get('docenteexamen/{identificacion}/get/docentes', 'DocenteexamenController@getDocentes')->name('docenteexamen.getdocentes');
    //ASIGNAR PARES
    Route::resource('asignarpar', 'AsignarparController');
    Route::get('asignarpar/{id}/delete', 'AsignarparController@destroy')->name('asignarpar.delete');
    Route::get('asignarpar/{identificacion}/get/docentes', 'AsignarparController@getDocentes')->name('asignarpar.getdocentes');
});
