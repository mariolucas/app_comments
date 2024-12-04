<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comentarios;
use Tymon\JWTAuth\Facades\JWTAuth;

class ComentariosController extends Controller
{
    public function salvaComentario(Request $request){

        $token = $request->bearerToken();
        $user = JWTAuth::authenticate($token);
        $id = $user->id; 

        $dados = Comentarios::create([
            'id_usuario' => $id,
            'comentario' => $request->input("comentario"),
        ]);
        
        return response()->json( $dados );
    }

    public function listaComentarios(){
        $comentarios = Comentarios::buscarComentarios();
        return response()->json( $comentarios );
    }

    public function meusComentarios(Request $request){

        $token = $request->bearerToken();
        $user = JWTAuth::authenticate($token);
        
        $comentarios = Comentarios::buscarComentariosPorUsuario( $user->id );
        return response()->json( $comentarios );
    }

    public function editaComentario(Request $request){
        $request->validate([
            'comentario' => 'required|string',
            'id_comentario' => 'required',
        ]);

        $token = $request->bearerToken();
        $user = JWTAuth::authenticate($token);
        $id_usuario = $user->id;

        // Busca no banco
        $comentario = Comentarios::where('id', $request->input('id_comentario'))
                                   ->where('id_usuario', $id_usuario)
                                   ->first();

        if (!$comentario) {
            return response()->json(['message' => 'Comentário não encontrado'], 404);
        }

        $comentario->comentario = $request->input('comentario');
        $comentario->save();

        return response()->json( $comentario );
    }


    public function deletaComentario($id){
        $comentario = Comentarios::find($id);

        if (!$comentario) {
            return response()->json(['message' => 'Comentário não encontrado'], 404);
        }

        $comentario->delete();
        return response()->json( $comentario );
    }
}
