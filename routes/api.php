<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CadastroController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ComentariosController;

Route::get('/comentarios',[ComentariosController::class, 'listaComentarios']);
Route::post('/novo-cadastro', [CadastroController::class, 'novoCadastro']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/valida-token', [AuthController::class, 'validaToken']);


Route::middleware(['authJwtApi'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    // Comentários
    Route::post('/salva-comentario', [ComentariosController::class, 'salvaComentario']);
    Route::get('/meus-comentarios', [ComentariosController::class, 'meusComentarios']);
    Route::post('/edita-comentario', [ComentariosController::class, 'editaComentario']);
    Route::get('/deleta-comentario/{id}', [ComentariosController::class, 'deletaComentario']);
    // Cadastro
    Route::get('/meu-cadastro', [CadastroController::class, 'meuCadastro']);
    Route::post('/edita-cadastro', [CadastroController::class, 'editaCadastro']);
});