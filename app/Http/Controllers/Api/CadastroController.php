<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class CadastroController extends Controller
{
    public function novoCadastro(Request $request){

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|min:8',
        ]);

        $usuario = Usuarios::create([
            'nome' => $request->input("nome"),
            'email' => $request->input("email"),
            'senha' => Hash::make($request->input('senha')),
        ]);

        return response()->json([
            "success" => true
        ], 201);
    }



    public function meuCadastro(Request $request){
        $token = $request->bearerToken();
        $usuario = JWTAuth::authenticate($token);

        $dados = [
            "nome" => $usuario->nome,
            "email" => $usuario->email
        ];

        return response()->json( $dados );
    }


    public function editaCadastro(Request $request){
        
        // Caso seja necessário refazer o login na alteração do email ou senha
        $logout = false;

        $token = $request->bearerToken();
        $usuario = JWTAuth::authenticate($token);
        $id = $usuario->id;

        $valid = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'senha' => 'nullable|min:8',
        ]);

        $usuario = Usuarios::find($id);

        if (!$usuario) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        // Verifica se o email foi alterado
        if ($request->email !== $usuario->email) {
            // Verificar se o novo e-mail já existe
            $emailExists = Usuarios::where('email', $request->email)->exists();

            if ($emailExists) {
                return response()->json(['error' => 'Este e-mail já está em uso'], 422);
            }

            $logout = true;
        }

        // atualiza campos
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;

        if ($request->input('senha')) {
            $usuario->senha = Hash::make( $request->input('senha') );
            $logout = true;
        }
        //Salva no banco
        $usuario->save();

        return response()->json([
            "success" => true,
            "logout" => $logout
        ], 201);

    }
}
