<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Rutas protegidas por autenticación
Route::group(["middleware" => ["auth"]], function () {

    // Panel de control
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    /* PARAMETROS */
    // PRODUCTOS
    Route::resource("products", ProductoController::class);
    Route::get("cambioestadoproducto", [ProductoController::class, "cambioestadoproducto"])->name("cambioestadoproducto");

    // CLIENTES
    Route::resource('clients', ClientController::class);
    Route::get("cambioestadocliente", [ClientController::class, "cambioestadocliente"])->name("cambioestadocliente");

    // ORDENES
    Route::resource('orders', OrderController::class);
    Route::get("cambioestadoorden", [OrderController::class, "cambioestadoorden"])->name("cambioestadoorden");

});
