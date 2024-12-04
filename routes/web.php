<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthWebController;
use App\Http\Controllers\Web\ComentariosController;
use App\Http\Controllers\Web\CadastroController;
use GuzzleHttp\Client;

Route::get('/', [ComentariosController::class, 'listaComentarios'])->name("comentarios");

Route::get('/login', function () {
    return view('login');
})->name("login");

Route::get('/novo-cadastro', function () {
    return view('novo-cadastro');
})->name("cadastro");

Route::middleware(['authJwtWeb'])->group(function () {
    Route::post('/salvar-comentario', [ComentariosController::class, 'salvar']);
    Route::post('/edita-comentario', [ComentariosController::class, 'editar']);
    Route::get('/meus-comentarios', [ComentariosController::class, 'meusComentarios'])->name("meusComentarios");
    Route::get('/deleta-comentario', [ComentariosController::class, 'deleta']);
    // Cadastro
    Route::get('/meu-cadastro', [CadastroController::class, 'meuCadastro'])->name("meuCadastro");
    Route::post('/edita-cadastro', [CadastroController::class, 'editaCadastro']);
    Route::get('/sair', [AuthWebController::class, 'logout'])->name("logout");
});
