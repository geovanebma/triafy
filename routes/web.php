<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/inicio');
    }
    
    return view('login');
})->name('login');

Route::get('/inicio', function () {
    return view('inicio');
})->middleware(['auth', 'verified'])->name('inicio');

// Route::get('/pedidos/todos', [PedidoController::class, 'listar'])->name('pedidos.listar');
// Route::get('/pedidos/create', [PedidoController::class, 'listar'])->name('pedidos.create');
// Route::get('/pedidos/filtro', [PedidoController::class, 'filtro'])->name('pedidos.filtro');

Route::get('/pedidos', function () {
    return view('inicio');
})->middleware(['auth', 'verified'])->name('pedidos.page');


Route::get('/pedidos/todos', [PedidoController::class, 'listar'])->name('pedidos.listar');
Route::get('/pedidos/filtro', [PedidoController::class, 'filtro'])->name('pedidos.filtro');

// Route::resource('produtos', ProdutoController::class);
// Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
Route::get('/produtos/gerar-sku', [ProdutoController::class, 'gerarSku'])->name('produtos.gerarSku');
Route::get('/produtos/exportar', [ProdutoController::class, 'exportar'])->name('produtos.exportar');


Route::get('parceiros', function () {
    return view('parceiros.index');
})->name('parceiros.index');

Route::get('/margem', [ProdutoController::class, 'margem'])->name('produtos.margem');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
