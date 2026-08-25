<?php

use App\Models\User;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::view('/landing', 'landing');
Route::view('/admin', 'admin.dashboard');

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