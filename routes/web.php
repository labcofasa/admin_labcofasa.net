<?php

use App\Http\Controllers\AjustesController;
use App\Http\Controllers\AplicacionesController;
use App\Http\Controllers\Auth\AutenticacionController;
use App\Http\Controllers\Auth\RestablecerController;
use App\Http\Controllers\ClasificacionController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EntidadController;
use App\Http\Controllers\GiroController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\PapeleraController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RedSocialController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Models\Aplicacion;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


Route::middleware(['auth'])->group(function () {
    /* Página inicio */
    Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');
    Route::get('/cerrar-sesion', [AutenticacionController::class, 'cerrarSesion'])->name('cerrar.sesion');

    /* Página usuarios */
    Route::get('/usuarios', [UsuarioController::class, 'index'])
        ->name('pag.usuarios')
        ->middleware('can:admin_usuarios_ver');
    Route::get('/tabla-usuarios', [UsuarioController::class, 'tablaUsuarios']);
    Route::post('/crear-usuario', [UsuarioController::class, 'store']);
    Route::put('/actualizar-usuario/{id}', [UsuarioController::class, 'update']);
    Route::delete('/eliminar-usuario/{id}', [UsuarioController::class, 'destroy']);

    Route::get('/obtener-estadisticas-usuarios', [UsuarioController::class, 'obtenerEstadisticasUsuarios']);

    /* Página roles */
    Route::get('/roles', [RolController::class, 'index'])->name('pag.roles');
    Route::get('/obtener-roles', [RolController::class, 'obtenerRoles']);
    Route::get('/obtener-roles-usuario', [RolController::class, 'obtenerRolesUsuarios']);
    Route::post('/crear-rol', [RolController::class, 'store']);
    Route::put('/actualizar-rol/{id}', [RolController::class, 'update']);
    Route::delete('/eliminar-rol/{id}', [RolController::class, 'destroy']);

    /* Página permisos */
    Route::get('/permisos', [PermisoController::class, 'index'])->name('pag.permisos');
    Route::get('/obtener-permisos', [PermisoController::class, 'obtenerPermisos']);
    Route::get('/permisos/{rolId}', [PermisoController::class, 'permisosRol']);
    Route::post('/eliminar-permiso/{rolId}/{permisoId}', [PermisoController::class, 'eliminarPermiso']);
    Route::post('/eliminar-permisos-masa', [PermisoController::class, 'eliminarPermisosMasa']);
    Route::get('/permisos-asignar/{rolId}', [PermisoController::class, 'permisosAsignar']);
    Route::post('/asignar-permiso/{rolId}/{permisoId}', [PermisoController::class, 'asignarPermisoARol']);
    Route::post('/asignar-permisos-masa', [PermisoController::class, 'asignarPermisosMasa']);

    /* Página empresas */
    Route::get('/empresas', [EmpresaController::class, 'index'])
        ->name('pag.empresas')
        ->middleware('can:admin_empresas_ver');


    Route::get('/obtener-empresas', [EmpresaController::class, 'obtenerEmpresas']);
    Route::get('/tabla-empresas', [EmpresaController::class, 'tablaEmpresas']);
    Route::post('/crear-empresa', [EmpresaController::class, 'store']);
    Route::put('/actualizar-empresa/{id}', [EmpresaController::class, 'update']);
    Route::delete('/eliminar-empresa/{id}', [EmpresaController::class, 'destroy']);

    /* Redes sociales */
    Route::delete('/redes-sociales/{redSocial}', [RedSocialController::class, 'destroy']);

    /* Papelera */
    Route::get('/papelera', [PapeleraController::class, 'index'])->name('pag.papelera');
    Route::get('/obtener-eliminados', [PapeleraController::class, 'obtenerEliminados']);
    Route::get('/restore/{table}/{id}', [PapeleraController::class, 'restoreRecord']);

    /* Entidades de empresas */
    Route::post('/crear-entidad', [EntidadController::class, 'store']);
    Route::get('/obtener-entidades', [EntidadController::class, 'obtenerEntidades']);
    Route::get('/tabla-entidades', [EntidadController::class, 'tablaEntidades']);
    Route::put('/actualizar-entidad/{id}', [EntidadController::class, 'update']);
    Route::delete('/eliminar-entidad/{id}', [EntidadController::class, 'destroy']);

    /* Clasificaciones de empresas */
    Route::get('/obtener-clasificaciones', [ClasificacionController::class, 'obtenerClasificaciones']);
    Route::post('/crear-clasificacion', [ClasificacionController::class, 'store']);
    Route::get('/tabla-clasificaciones', [ClasificacionController::class, 'tablaClasificaciones']);
    Route::put('/actualizar-clasificacion/{id}', [ClasificacionController::class, 'update']);
    Route::delete('/eliminar-clasificacion/{id}', [ClasificacionController::class, 'destroy']);

    /* Giros de empresas */
    Route::get('/obtener-giros', [GiroController::class, 'obtenerGiros']);
    Route::get('/tabla-giros', [GiroController::class, 'tablaGiros']);
    Route::post('/crear-giro', [GiroController::class, 'store']);
    Route::put('/actualizar-giro/{id}', [GiroController::class, 'update']);
    Route::delete('/eliminar-giro/{id}', [GiroController::class, 'destroy']);

    /* Paises */
    Route::get('/obtener-paises', [PaisController::class, 'index']);
    Route::get('/tabla-paises', [PaisController::class, 'tablaPaises']);
    Route::post('/crear-pais', [PaisController::class, 'store']);
    Route::put('/actualizar-pais/{id}', [PaisController::class, 'update']);
    Route::delete('/eliminar-pais/{id}', [PaisController::class, 'destroy']);

    /* Departamentos */
    Route::get('/obtener-departamentos/{pais_id}', [DepartamentoController::class, 'index']);
    Route::get('/departamentos/{paisId}', [DepartamentoController::class, 'tablaDepartamentos']);
    Route::post('/crear-departamento/{paisId}', [DepartamentoController::class, 'store']);
    Route::put('/actualizar-departamento/{id}', [DepartamentoController::class, 'update']);
    Route::delete('/eliminar-departamento/{id}', [DepartamentoController::class, 'destroy']);

    /* Municipios */
    Route::get('/obtener-municipios/{departamento_id}', [MunicipioController::class, 'index']);
    Route::get('/municipios/{departamentoId}', [MunicipioController::class, 'tablaMunicipios']);
    Route::post('/crear-municipio/{municipioId}', [MunicipioController::class, 'store']);
    Route::put('/actualizar-municipio/{id}', [MunicipioController::class, 'update']);
    Route::delete('/eliminar-municipio/{id}', [MunicipioController::class, 'destroy']);

    /* Página mi cuenta */
    Route::get('/mi-cuenta', [CuentaController::class, 'index'])->name('pag.cuenta');
    Route::get('/obtener-usuario', [CuentaController::class, 'obtenerUsuario']);
    Route::post('/actualizar-clave', [CuentaController::class, 'actualizarClave']);

    /* Configuración */
    Route::get('/ajustes', [AjustesController::class, 'index'])->name('pag.ajustes');

    /* Aplicaciones */
    Route::get('/aplicaciones', [AplicacionesController::class, 'index'])->name('pag.aplicaciones');
    Route::get('/tabla-aplicaciones', [AplicacionesController::class, 'tablaAplicaciones']);
});

Route::middleware(['guest'])->group(function () {
    /* Página inicio de sesión */
    Route::get('/', [AutenticacionController::class, 'mostrarFormulario'])->name('autenticarme');
    Route::post('/autenticar', [AutenticacionController::class, 'autenticaUsuario'])->name('autenticar.usuario');

    /* Página restablecer contraseña */
    Route::get('/restablecer', [RestablecerController::class, 'formularioRestablecer'])->name('form.restablecer');
    Route::post('/enviar-enlace', [RestablecerController::class, 'enviarCorreo'])->name('enviar.enlace');

    /* Página actualizar contraseña */
    Route::get('/restablecer/clave/{token}', [RestablecerController::class, 'formularioNuevaClave'])->name('form.reseteo');
    Route::post('/restablecer/nueva-clave', [RestablecerController::class, 'restablecerNuevaClave'])->name('actualizar.clave');
});

/* Logo de la empresa */
Route::get('empresas/{id}/logo', [EmpresaController::class, 'mostrarLogo']);
Route::get('empresas/{id}/leyenda', [EmpresaController::class, 'mostrarLeyenda']);

