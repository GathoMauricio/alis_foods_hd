<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function () {
    //Home (Tickets)
    Route::get('home/{sucursal?}/', [App\Http\Controllers\TicketController::class, 'index'])->name('home');
    Route::get('crear_tickets/{id?}', [App\Http\Controllers\TicketController::class, 'create'])->name('crear_tickets')->middleware('permission:crear_tickets');
    Route::post('store_tickets', [App\Http\Controllers\TicketController::class, 'store'])->name('store_tickets');
    Route::get('show_tickets/{id}', [App\Http\Controllers\TicketController::class, 'show'])->name('show_tickets');
    Route::put('estatus_ticket', [App\Http\Controllers\TicketController::class, 'estatusTicket'])->name('estatus_ticket');
    Route::get('historico/{sucursal?}', [App\Http\Controllers\TicketController::class, 'historico'])->name('historico');
    Route::put('asignar_ticket', [App\Http\Controllers\TicketController::class, 'asignarTicket'])->name('asignar_ticket');

    //Roles y permisos
    Route::get('roles_permisos', [App\Http\Controllers\RolesPermisosController::class, 'index'])->name('roles_permisos')->middleware('permission:modulo_roles_permisos');
    Route::post('actualizar_roles_permisos', [App\Http\Controllers\RolesPermisosController::class, 'updatePermisos'])->name('actualizar_roles_permisos')->middleware('permission:modulo_roles_permisos');

    //Usuarios
    Route::get('usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('usuarios')->middleware('permission:modulo_usuarios');
    Route::get('detalle_usuarios/{id?}', [App\Http\Controllers\UserController::class, 'show'])->name('detalle_usuarios')->middleware('permission:detalle_usuarios');
    Route::get('crear_usuarios', [App\Http\Controllers\UserController::class, 'create'])->name('crear_usuarios')->middleware('permission:crear_usuarios');
    Route::post('store_usuarios', [App\Http\Controllers\UserController::class, 'store'])->name('store_usuarios')->middleware('permission:crear_usuarios');
    Route::get('editar_usuarios/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('editar_usuarios')->middleware('permission:editar_usuarios');
    Route::put('update_usuarios/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('update_usuarios')->middleware('permission:editar_usuarios');
    Route::delete('eliminar_usuarios/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('eliminar_usuarios')->middleware('permission:eliminar_usuarios');

    //Sucursales
    Route::get('sucursales', [App\Http\Controllers\SucursalController::class, 'index'])->name('sucursales')->middleware('permission:modulo_sucursales');
    Route::get('detalle_sucursales/{id?}', [App\Http\Controllers\SucursalController::class, 'show'])->name('detalle_sucursales')->middleware('permission:detalle_sucursales');
    Route::get('crear_sucursales', [App\Http\Controllers\SucursalController::class, 'create'])->name('crear_sucursales')->middleware('permission:crear_sucursales');
    Route::post('store_sucursales', [App\Http\Controllers\SucursalController::class, 'store'])->name('store_sucursales')->middleware('permission:crear_sucursales');
    Route::get('editar_sucursales/{id}', [App\Http\Controllers\SucursalController::class, 'edit'])->name('editar_sucursales')->middleware('permission:editar_sucursales');
    Route::put('update_sucursales/{id}', [App\Http\Controllers\SucursalController::class, 'update'])->name('update_sucursales')->middleware('permission:editar_sucursales');
    Route::delete('eliminar_sucursales/{id}', [App\Http\Controllers\SucursalController::class, 'destroy'])->name('eliminar_sucursales')->middleware('permission:eliminar_sucursales');

    //Seguimientos
    Route::post('store_seguimientos', [App\Http\Controllers\SeguimientoController::class, 'store'])->name('store_seguimientos');
    Route::delete('delete_seguimientos_ticket/{id}', [App\Http\Controllers\SeguimientoController::class, 'destroy'])->name('delete_seguimientos_ticket');

    //Adjuntos
    Route::post('store_adjuntos', [App\Http\Controllers\AdjuntoController::class, 'store'])->name('store_adjuntos');
    Route::delete('delete_adjuntos_ticket/{id}', [App\Http\Controllers\AdjuntoController::class, 'destroy'])->name('delete_adjuntos_ticket');

    #AxiosData
    Route::get('cargar_subcategorias', [App\Http\Controllers\AxiosController::class, 'cargarSubcategorias'])->name('cargar_subcategorias');
    Route::get('cargar_servicios', [App\Http\Controllers\AxiosController::class, 'cargarServicios'])->name('cargar_servicios');
    Route::get('cargar_sintomas', [App\Http\Controllers\AxiosController::class, 'cargarSintomas'])->name('cargar_sintomas');
    Route::get('cargar_sintoma', [App\Http\Controllers\AxiosController::class, 'cargarSintoma'])->name('cargar_sintoma');
    Route::get('cargar_sugerencia', [App\Http\Controllers\AxiosController::class, 'cargarSugerencia'])->name('cargar_sugerencia');
    Route::get('cargar_subcategoria', [App\Http\Controllers\AxiosController::class, 'cargarSubcategoria'])->name('cargar_subcategoria');
    //Categorias
    Route::get('categorias', [App\Http\Controllers\CategoriaController::class, 'index'])->name('categorias');
    Route::post('store_categoria', [App\Http\Controllers\CategoriaController::class, 'storeCategoria'])->name('store_categoria');
    Route::post('store_subcategoria', [App\Http\Controllers\CategoriaController::class, 'storeSubcategoria'])->name('store_subcategoria');

    //Subcategorias
    Route::put('update_subcategoria', [App\Http\Controllers\ServicioController::class, 'updateSubcategoria'])->name('update_subcategoria');
    Route::get('servicios/{id}', [App\Http\Controllers\ServicioController::class, 'index'])->name('servicios');
    Route::post('store_servicio', [App\Http\Controllers\ServicioController::class, 'storeServicio'])->name('store_servicio');
    Route::post('store_sintoma', [App\Http\Controllers\ServicioController::class, 'storeSintoma'])->name('store_sintoma');
    Route::put('update_sintoma', [App\Http\Controllers\ServicioController::class, 'updateSintoma'])->name('update_sintoma');

    //Sugerencias
    Route::get('sugerencias/{id}', [App\Http\Controllers\SugerenciaController::class, 'index'])->name('sugerencias');
    Route::post('store_sugerencia', [App\Http\Controllers\SugerenciaController::class, 'storeSugerencia'])->name('store_sugerencia');

    //Distrital
    Route::get('distrital', [App\Http\Controllers\DistritalSucursalController::class, 'index'])->name('distrital')->middleware('distrital');
    Route::get('show_distrital/{id}', [App\Http\Controllers\DistritalSucursalController::class, 'show'])->name('show_distrital')->middleware('distrital');
    Route::get('historico_distrital', [App\Http\Controllers\DistritalSucursalController::class, 'historico'])->name('historico_distrital')->middleware('distrital');
    //Reportes
    Route::get('reportes', [App\Http\Controllers\ReporteController::class, 'index'])->name('reportes');
    Route::post('generar_reporte', [App\Http\Controllers\ReporteController::class, 'generarReporte'])->name('generar_reporte');
});


Route::any('/', function () {})->name('/');
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('home');
    }
    return view('auth.login');
})->name('/');
