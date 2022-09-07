<?php



use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Panel\HomeController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\Consulta_EntradaController;
use App\Http\Controllers\Consulta_SalidaController;
use App\Http\Controllers\SubcategoriaController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ExistenciaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\SalidaController;

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


Route::get('/menu', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('auth.login');
});


// Ruta del panel principal
Route::middleware(['auth:sanctum', 'verified'])->get('/panel', [HomeController::class, 'index'])
    ->name('panel.home');


# /panel/rutas/
Route::group(['prefix' => 'panel'], function () {
    // ruta panel/proveedor
    Route::middleware(['auth:sanctum', 'verified'])
        ->resource('proveedor', ProveedorController::class);

    // ruta panel/usuario
    Route::middleware(['auth:sanctum', 'verified'])
        ->resource('usuario', UsuarioController::class)
        ->middleware('can:panel.usuarios');

    // ruta panel/roles
    Route::middleware(['auth:sanctum', 'verified'])
        ->resource('roles', RoleController::class)
        ->names(['store' => 'roles.store'])
        ->middleware('can:panel.usuarios');

    // ruta panel/articulo
    Route::middleware(['auth:sanctum', 'verified'])
        ->resource('articulo', ArticuloController::class);

    // ruta panel/subcategoria
    Route::middleware(['auth:sanctum', 'verified'])
        ->resource('subcategoria', SubcategoriaController::class);

    // ruta panel/servicio
    Route::middleware(['auth:sanctum', 'verified'])
        ->resource('servicio', ServicioController::class);

    // ruta panel/existencia
    Route::middleware(['auth:sanctum', 'verified'])
        ->resource('existencia', ExistenciaController::class);

    // ruta panel/consulta_entrada
    Route::middleware(['auth:sanctum', 'verified'])
        ->resource('consulta_entrada', Consulta_EntradaController::class);

    // ruta panel/consulta_salida
    Route::middleware(['auth:sanctum', 'verified'])
        ->resource('consulta_salida', Consulta_SalidaController::class);

    // ruta panel/entrada
    Route::middleware(['auth:sanctum', 'verified'])
        ->resource('entrada', EntradaController::class)
        ->middleware('can:panel.entradas');

    // ruta panel/salida
    Route::middleware(['auth:sanctum', 'verified'])
        ->resource('salida', SalidaController::class)
        ->middleware('can:panel.salidas');

    // fin de la ruta articulo

});

// Se crea la ruta para el controlador proveedores
// este controlador ya trae por defecto los metodos del CRUD
// y cada vez que se llame a la ruta proveedores se accedan a los metodos
// Route::resource('proveedor','App\Http\Controllers\ProveedorController');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
