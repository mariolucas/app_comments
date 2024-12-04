<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ComentariosController extends Controller
{
    public function salvar(Request $request){

        $comentario = $request->input('comentario');
        $token = $_COOKIE['api_token'] ?? null;

        if (!$token) {
            return response()->json(['erro' => 'Não autorizado'], 400);
        }

        $dados = [
            "comentario" => $comentario
        ];

        $res = $request->validate([
            'comentario' => 'required|string',
        ]);

        $client = new Client();

        $url = env("API_URL");

        $return = $client->post($url."/salva-comentario", [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ],
            'json' => $dados,
        ]);

        $body = json_decode($return->getBody(), true);

        return redirect()->route("comentarios");
    }

    public function editar(Request $request){

        $token = $_COOKIE['api_token'] ?? null;

        $validated = $request->validate([
            'comentario' => 'required|string',
            'id_comentario' => 'required',
        ]);

        $dados = [
            "id_comentario" => $request->input('id_comentario'),
            "comentario" => $request->input('comentario')
        ];

        $client = new Client();

        $url = env("API_URL");

        $return = $client->post($url."/edita-comentario", [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ],
            'json' => $dados,
        ]);

        $body = json_decode($return->getBody(), true);

        return redirect()->route("meusComentarios");

    }


    public function listaComentarios(){
        $client = new Client();
        $url = env("API_URL");
        $response = $client->get($url."/comentarios");

        $dados = json_decode($response->getBody()->getContents(), true);

        return view('comentarios', ['comentarios' => $dados] );
    }

    public function meusComentarios(){

        $token = $_COOKIE['api_token'] ?? null;

        if (!$token) {
            return response()->json(['erro' => 'Não autorizado'], 400);
        }

        $client = new Client();
        $url = env("API_URL");
        $response = $client->get($url."/meus-comentarios/",  [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ],
        ]);

        $dados = json_decode($response->getBody()->getContents(), true);

        return view('meus-comentarios', ['comentarios' => $dados] );
    }

    public function deleta($id){
        $token = $_COOKIE['api_token'] ?? null;

        $client = new Client();

        $url = env("API_URL");

        $return = $client->get($url."/deleta-comentario/".$id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ]
        ]);

        $body = json_decode($return->getBody(), true);

        return redirect()->route("meusComentarios");
    }
}
