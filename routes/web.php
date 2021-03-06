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
    // Artisan::call('migrate:fresh --seed');
    // Artisan::call('cache:clear');
    // Artisan::call('config:clear');
    // Artisan::call('config:cache');
    // Artisan::call('storage:link');
    // Artisan::call('key:generate');

});

Auth::routes(['verify' => true]);
Route::middleware(['verified', 'auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    // perfil de usuario
    Route::get('/mi-perfil', 'HomeController@miPerfil')->name('miPerfil');
    Route::post('/actualizar-mi-perfil', 'HomeController@miPerfilActualizar')->name('actualizarMiPerfil');


    //A:Deivid
    //D. Roles y permisos de sistema solo acesso Administrador
    Route::namespace('Sistema')->group(function () {
        // roles
        Route::get('/roles', 'Roles@index')->name('roles');
        Route::post('/roles-guardar', 'Roles@guardar')->name('guardarRol');
        Route::post('/roles-eliminar', 'Roles@eliminar')->name('eliminarRol');
        // permisos
        Route::get('/permisos/{idRol}', 'Permisos@index')->name('permisos');
        Route::post('/permisos-sincronizar', 'Permisos@sincronizar')->name('sincronizarPermiso');
    });


    Route::namespace('Usuario')->group(function () {
        // Usuarios
        Route::get('/usuarios', 'Usuarios@index')->name('usuarios');
        Route::get('/usuarios-nuevo', 'Usuarios@nuevo')->name('usuariosNuevo');
        Route::post('/usuarios-guardar', 'Usuarios@guardar')->name('guardarUsuario');
        Route::post('/usuarios-eliminar', 'Usuarios@eliminar')->name('eliminarUsuario');
        Route::get('/usuarios-editar-rol/{idUsuario}', 'Usuarios@editarRol')->name('editarRolUsuario');
        Route::post('/usuarios-actualizar-roles', 'Usuarios@actualizarRolUsuario')->name('actualizarRolUsuario');
        Route::get('/usuarios-editar/{idUsuario}', 'Usuarios@editar')->name('editarUsuario');
        Route::post('/usuarios-actualizar', 'Usuarios@actualizar')->name('actualizarUsuario');
        Route::get('/usuarios-informacion/{idUsuario}', 'Usuarios@informacion')->name('informacionUsuario');
        Route::get('/usuarios-rol/{nombreRol}', 'Usuarios@usuariosPoRol')->name('usuariosPoRol');
        Route::get('/usuarios-informacion-pdf/{idUsuario}', 'Usuarios@informacionPdf')->name('usuarioInformacionPdf');
        Route::get('/usuarios-informacion-imprimir/{idUsuario}', 'Usuarios@informacionImprimir')->name('usuarioInformacionImprimir');
        Route::get('/usuarios-importar', 'Usuarios@importar')->name('usuariosImportar');
        Route::post('/usuarios-procesar-importar', 'Usuarios@procesarImportacion')->name('procesarImportacionUsuarios');

    });

    //A:Fabian Lopez
    //D. administracion de estaciones
    Route::get('/estaciones', 'Estaciones@index')->name('estaciones');
    Route::get('/nueva-estacion', 'Estaciones@nueva')->name('nuevaEstacion');
    Route::post('/guardarEstacion', 'Estaciones@guardar')->name('guardarEstacion');
    Route::get('/editar-estacion/{id}', 'Estaciones@editar')->name('editarEstacion');
    Route::post('/actualizar-estacion', 'Estaciones@actualizar')->name('actualizarEstacion');
    Route::post('/eliminar-estacion', 'Estaciones@eliminar')->name('eliminarEstacion');
    Route::get('/cambio-de-personal', 'Estaciones@cambioPersonal')->name('cambioPersonal');
    Route::post('/actualizar-personal-en-estacion', 'Estaciones@actualizarPersonalEstacion')->name('actualizarPersonalEstacion');
    Route::get('/lista-estacion', 'Estaciones@cargaListado')->name('listaEstacion');

    Route::get('/cambio-de-vehiculo', 'Estaciones@cambioVehiculo')->name('cambioVehiculo');
    Route::post('/actualizar-vehiculo-en-estacion', 'Estaciones@actualizarVehiculoEstacion')->name('actualizarVehiculoEstacion');
    Route::get('/lista-Vehiculo-estacion', 'Estaciones@cargaListadoVehiculo')->name('listaVehiculoEstacion');

    // A:Deivid
    // D:gestion de emergencias
    Route::namespace('Emergencias')->group(function () {
        // emergencias
        Route::get('/emergencia', 'Emergencias@index')->name('emergencia');
        Route::post('/emergencia-guardar', 'Emergencias@guardar')->name('emergenciaGuardar');
        Route::get('/emergencia-editar/{id}', 'Emergencias@editar')->name('editarEmergencia');
        Route::post('/emergencia-actualizar', 'Emergencias@actualizar')->name('emergenciaActualizar');
        Route::post('/emergencia-eliminar', 'Emergencias@eliminar')->name('eliminarEmergencia');
        // tipo de emergencia

        Route::get('/tipo-emergencia/{idEmergencia}', 'TipoEmergencias@index')->name('tipoEmergencia');
        Route::post('/tipo-emergencia-guardar', 'TipoEmergencias@guardar')->name('guardarTipoEmergencia');
        Route::get('/tipo-emergencia-editar/{id}', 'TipoEmergencias@editar')->name('editarTipoEmergencia');
        Route::post('/tipo-emergencia-actualizar', 'TipoEmergencias@actualizar')->name('actualizarTipoEmergencia');
        Route::post('/tipo-emergencia-eliminar', 'TipoEmergencias@eliminar')->name('eliminarTipoEmergencia');
    });

    //A:Fabian Lopez
    //D. administracion de clinicas
    Route::get('/clinicas', 'Clinicas@index')->name('clinicas');
    Route::post('/nueva-clinica', 'Clinicas@guardar')->name('guardarClinica');
    Route::get('/editar-clinica/{id}', 'Clinicas@editar')->name('editarClinica');
    Route::post('/actualizar-clinica', 'Clinicas@actualizar')->name('actualizarClinica');
    Route::post('/eliminar-clinica', 'Clinicas@eliminar')->name('eliminarClinica');

    //A:Fabian Lopez
    //D. administracion de parroquias
    Route::get('/parroquias', 'Parroquias@index')->name('parroquias');
    Route::post('/nueva-parroquia', 'Parroquias@guardar')->name('guardarParroquia');
    Route::get('/editar-parroquia/{id}', 'Parroquias@editar')->name('editarParroquia');
    Route::post('/actualizar-parroquia', 'Parroquias@actualizar')->name('actualizarParroquia');
    Route::post('/eliminar-parroquia', 'Parroquias@eliminar')->name('eliminarParroquia');
     //A:Fabian Lopez
    //D. administracion de barrios
    Route::get('/barrios', 'Barrios@index')->name('barrios');
    Route::get('/nuevo-barrios', 'Barrios@nuevo')->name('nuevoBarrio');
    Route::post('/guardar-barrio', 'Barrios@guardar')->name('guardarBarrio');
    Route::get('/editar-barrio/{id}', 'Barrios@editar')->name('editarBarrio');
    Route::post('/actualizar-barrio', 'Barrios@actualizar')->name('actualizarBarrio');
    Route::post('/barrio-eliminar', 'Barrios@eliminar')->name('barrioEliminar');

    //A:Fabian Lopez
    //D. administracion de puntos de referencia
    Route::get('/puntos-referencia', 'PuntosReferencias@index')->name('puntosReferencia');
    Route::get('/puntos-referencia-nuevo', 'PuntosReferencias@nuevo')->name('puntosReferenciaNuevo');
    Route::post('/puntos-referencia-guardar', 'PuntosReferencias@guardar')->name('puntosReferenciaGuardar');
    Route::get('/puntos-referencia-mapa', 'PuntosReferencias@mapa')->name('puntosReferenciaMapa');
    Route::get('/editar-referencia/{id}', 'PuntosReferencias@editar')->name('editarReferencia');
    Route::post('/puntos-referencia-actualizar', 'PuntosReferencias@actualizar')->name('puntosReferenciaActualizar');
    Route::post('/puntos-referencia-eliminar', 'PuntosReferencias@eliminar')->name('puntosReferenciaEliminar');
    // parroquias y barrios
    Route::post('/obtener-barrios-x-parroquia', 'PuntosReferencias@obtenerBarrios')->name('obtenerBarrios');

   //importar puntos de referencia
   Route::get('/puntos-referencia-importar', 'PuntosReferencias@importar')->name('puntosReferenciaImportar');
   Route::post('/puntos-referencia-guardar-importacion', 'PuntosReferencias@guardarImportacion')->name('puntosGuardarImportacion');

    //A:Fabian Lopez
    //D. administracion de puntos de Vehiculos
    Route::namespace('Vehiculos')->group(function () {
        // tipos de vehiculos
        Route::get('/tipo-vehiculos', 'TipoVehiculos@index')->name('tipoVehiculos');
        Route::post('/guardar-tipo-vehiculo', 'TipoVehiculos@guardar')->name('guardarTipoVehiculo');
        Route::get('/editar-tipo-vehiculo/{id}', 'TipoVehiculos@editar')->name('editarTipoVehiculo');
        Route::post('/actualizar-tipo-vehiculo', 'TipoVehiculos@actualizar')->name('actualizarTipoVehiculo');
        Route::post('/eliminar-tipo-vehiculo', 'TipoVehiculos@eliminar')->name('eliminarTipoVehiculo');

        // vehiculos
        Route::get('/vehiculos/{id}', 'Vehiculos@index')->name('vehiculos');
        Route::get('/nuevo-vehiculos/{id}', 'Vehiculos@nuevo')->name('nuevoVehiculo');
        Route::post('/guardar-vehiculo', 'Vehiculos@guardar')->name('guardarVehiculo');
        Route::get('/editar-vehiculos/{id}', 'Vehiculos@editar')->name('editarVehiculo');
        Route::post('/actualizar-vehiculo', 'Vehiculos@actualizar')->name('actualizarVehiculo');

        Route::get('/importar-vehiculos', 'Vehiculos@importar')->name('importarVehiculos');
        Route::post('/importar-archivo', 'Vehiculos@importarArchivo')->name('imnportarArchivoVehiculos');
        Route::post('/eliminar-vehiculo', 'Vehiculos@eliminar')->name('eliminarVehiculo');

    });

    Route::namespace('Descargos')->group(function () {
        //insumos
        Route::get('/insumos', 'Insumos@index')->name('insumos');
        Route::post('/insumos-guardar', 'Insumos@guardar')->name('insumosGuardar');
        Route::get('/insumos-editar/{id}', 'Insumos@editar')->name('editarInsumo');
        Route::post('/insumos-actualizar', 'Insumos@actualizar')->name('insumosActualizar');
        Route::post('/insumos-eliminar', 'Insumos@eliminar')->name('eliminarInsumo');

        // medicamentos
        Route::get('/medicamentos/{insumo}', 'Medicamentos@index')->name('medicamentos');
        Route::post('/medicamentos-guardar', 'Medicamentos@guardar')->name('medicamentosGuardar');
        Route::get('/medicamentos-editar/{id}', 'Medicamentos@editar')->name('editarMedicamento');
        Route::post('/medicamentos-actualizar', 'Medicamentos@actualizar')->name('medicamentoActualizar');
        Route::post('/medicamentos-eliminar', 'Medicamentos@eliminar')->name('eliminarMedicamento');

    });

    Route::get('/generar-estaditica', 'Reportes@estadisticas')->name('generarEstadisticas');
    Route::get('/buscar-reporte', 'Reportes@resporteMes')->name('buscarReporte');
    Route::get('/exportar-reporte/{fecha}', 'Reportes@exportarReporte')->name('exportarReporte');
    Route::get('/header-reporte', 'Reportes@headrePdf')->name('headerReporte');


    Route::namespace('Asistencias')->group(function () {
        //insumos
        Route::get('/generar-asistencia', 'Asistencias@index')->name('generarAsistencia');
        Route::get('/crear-asistencia/{estacion}', 'Asistencias@crearAsistencia')->name('crearAsistencia');
        Route::post('/crear-nueva-asistencia', 'Asistencias@crearNuevaAsistencia')->name('crearNuevaAsistencia');

        Route::post('/estado-personal-asistencia', 'Asistencias@estadoPersonal')->name('estadoAsistenciaPersonal');
        Route::post('/estado-vehiculo-asistencia', 'Asistencias@estadoVehiculo')->name('estadoAsistenciaVehiculo');
        Route::post('/observacion-personal-asistencia', 'Asistencias@obsPersonal')->name('obsAsistenciaPersonal');
        Route::post('/observacion-vehiculo-asistencia', 'Asistencias@obsVehiculo')->name('obsAsistenciaVehiculo');
        Route::get('/listado-personal-asistencia-exportar-pdf/{asistencia}', 'Asistencias@exportarPdf')->name('exportPdfAsistencia');
        Route::get('/buscar-asistencia/{estacion}', 'Asistencias@buscarAsistencia')->name('buscarAsistencia');

    });
    Route::namespace('Formularios')->group(function () {
        Route::get('formularios','FormularioEmergencias@index' )->name('formularios');
        Route::get('/nuevo-formulario','FormularioEmergencias@nuevo' )->name('nuevo-formulario');
        Route::get('/proceso-formulario/{id}','FormularioEmergencias@proceso' )->name('proceso-formulario');
        Route::get('/editar-formulario/{id}','FormularioEmergencias@editarFormulario' )->name('editar-formulario');

        Route::get('/cargarPersonalUnidadesDespachadas/{id}','FormularioEmergencias@cargarPersonalUnidadesDespachadas' )->name('cargarPersonalUnidadesDespachadas');


        Route::post('/formulario-guardar', 'FormularioEmergencias@guardarFormulario')->name('guardarFormulario');
        Route::post('/buscar-puntos-referencia', 'FormularioEmergencias@buscarPuntoReferenciaId')->name('buscarPuntosReferencia');
        Route::post('/formulario-buscar-personal-Operador', 'FormularioEmergencias@buscarPersonalOperador')->name('buscarPersonalOperadorFormulario');
        Route::post('/formulario-buscar-personal-Operativo', 'FormularioEmergencias@buscarPersonalOperativo')->name('buscarPersonalOperativoFormulario');
        Route::post('/formulario-buscar-personal-Paramedico', 'FormularioEmergencias@buscarPersonalParamedico')->name('buscarPersonalParamedicoFormulario');

        //buscar usuarios para editar
        Route::post('/formulario-buscar-personal-Operador-ediatar', 'FormularioEmergencias@buscarPersonalOperadorEditar')->name('buscarPersonalOperadorFormularioEditar');
        Route::post('/formulario-buscar-personal-Operativo-ediatar', 'FormularioEmergencias@buscarPersonalOperativoEditar')->name('buscarPersonalOperativoFormularioEditar');
        Route::post('/formulario-buscar-personal-Paramedico-ediatar', 'FormularioEmergencias@buscarPersonalParamedicoEditar')->name('buscarPersonalParamedicoFormularioEditar');

        //artualizar formulario
        Route::post('/formulario-actualizar', 'FormularioEmergencias@actualizarFormulario')->name('ActualizarFormulario');



        Route::get('/informacion-formulario/{id}','FormularioEmergencias@informacionFormulario' )->name('informacion-formulario');
        Route::get('/atenciones/{formulario}','AtencionPrehospitalarias@index' )->name('atenciones');
        Route::get('/nueva-atencion/{id}','AtencionPrehospitalarias@nuevo' )->name('nueva-atencion');
        Route::post('/guardar-atencion','AtencionPrehospitalarias@guardarAtencion' )->name('guardar-atencion');
        Route::get('/editar-atencion/{id}','AtencionPrehospitalarias@editarAtencion' )->name('editar-atencion');
        Route::post('/actualizar-atencion','AtencionPrehospitalarias@actualizarAtencion' )->name('actualizar-atencion');
        //Completar mis formularios
        Route::get('/mis-formularios','FormularioEmergencias@misFormularios' )->name('mis-formulario');
        Route::post('/finalizar-formularios','FormularioEmergencias@finalizarFormulario' )->name('finalizar-formulario');
        //rutas para los materiales
        Route::get('/materiales-formularios/{id}','FormularioEmergencias@materialesFormulario' )->name('materiales-formulario');
        Route::post('/guardar-material','FormularioEmergencias@guardarMateriales' )->name('guardar-material');
        Route::post('/eliminar-material','FormularioEmergencias@eliminarMaterial' )->name('eliminar-material');

        //rutas para los materiales
        Route::get('/danios-formularios/{id}','FormularioEmergencias@daniosFormulario' )->name('danios-formulario');
        Route::post('/guardar-danio','FormularioEmergencias@guardarDanios' )->name('guardar-danio');
        Route::post('/eliminar-danio','FormularioEmergencias@eliminarDanio' )->name('eliminar-danio');
        //completar informacion del formulario

        Route::post('/completar-informacion','FormularioEmergencias@completarFormularioResposable' )->name('completar-informacion');
        //cambiar a proceso el formulario
        Route::post('/cambio-proceso-formularios','FormularioEmergencias@cambiarEstadoProceso' )->name('cambio-proceso-formulario');

        //anexos
        Route::get('/cambiar-anexos-formularios/{id}','FormularioEmergencias@cargarAnexos' )->name('cambiar-anexos-formulario');
        Route::post('/eliminar-anexos-formularios','FormularioEmergencias@eliminarAnexo' )->name('eliminar-anexos-formulario');
        //edificacines en base al formulario
        Route::get('/edificaciones-formularios/{id}','FormularioEmergencias@vistaTipoEdificacion' )->name('lista-edificaciones-formulario');

        Route::post('/guardar-edificacion-formularios','FormularioEmergencias@cerarEtapasIncendiEdificacion' )->name('guardar-edificacion-formulario');
        Route::post('/eliminar-edificacion-formularios','FormularioEmergencias@eliminarEtapasIncendiEdificacion' )->name('eliminar-edificacion-formulario');
        //incendio forestal
        Route::get('/incendio-forestal-formularios/{id}','FormularioEmergencias@vistaCondicionClimatica' )->name('incendio-forestal-formularios');
        Route::post('/guardar-forestal-formularios','FormularioEmergencias@cerarCondicionClimatica' )->name('guardar-forestal-formulario');
        Route::post('/eliminar-forestal-formularios','FormularioEmergencias@eliminarCondicionClimatica' )->name('eliminar-forestal-formulario');

        //imprimir formulario
        Route::get('/imprimir-formularios/{id}','FormularioEmergencias@imprimirFormulario' )->name('imprimir-formulario');
        Route::post('/formulario-imagen', 'FormularioEmergencias@guardarImagen')->name('formulario-imagen');
        Route::get('/formulario-imagen-vistas/{id}', 'FormularioEmergencias@imagenFormulario')->name('formularioImagenVista');
        Route::get('/formulario-descargar/{id}', 'FormularioEmergencias@descargarFormulario')->name('formulario-descargar');
        //buscar reporte



    });


});

Route::namespace('Movil')->group(function () {
    // login
    Route::get('/login-app/{email}/{password}', 'Consultas@login')->name('loginApp');
    Route::get('/consulta-usuario/{id}', 'Consultas@consultaFormularios')->name('consulta-usuario');
    Route::get('/consulta-formularios/{id}', 'Consultas@consultaMisFormularios')->name('consulta-formularios');

});
