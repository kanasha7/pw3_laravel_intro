<?php

use App\Models\User;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::view('/landing', 'landing');
Route::view('/admin', 'admin.dashboard');

Route::get('/admin', [UserController::class, 'index']);

//rota para carregar o formulario via (GET)
Route::get('/usuarios/novo', [UserController::class, 'create']);

//rota para salvar os dados enviados (POST)
Route::post('/usuarios', [UserController::class, 'store']);

//rotas de edição
Route::get('/usuarios/{id}/editar', [UserController::class, 'edit']);
Route::put('/usuarios/{id}', [UserController::class, 'update']);


Route::get('/livros', [LivroController::class, 'index']);
Route::post('/livros', [LivroController::class, 'store']);
Route::get('/produtos', [ProdutoController::class, 'index']);
Route::post('/produtos', [ProdutoController::class, 'store']);

Route::get('/teste-orm', function() {
    User::create([
        'name' => 'Laura Lima Santos Martins',
        'email' => 'lala@escola.sp.gov.br',
        'password' => '12345678'
    ]);

    return User::all();
});