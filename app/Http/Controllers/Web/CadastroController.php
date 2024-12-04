<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CadastroController extends Controller
{
    public function meuCadastro(){

        $token = $_COOKIE['api_token'] ?? null;

        if (!$token) {
            return response()->json(['erro' => 'Não autorizado'], 400);
        }

        $client = new Client();

        $url = env("API_URL");

        $return = $client->get($url."/meu-cadastro", [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ]
        ]);

        $dados = json_decode($return->getBody(), true);

        return view('meu-cadastro', ["dados" => $dados ]);
    }

    public function editaCadastro(Request $request){

        $token = $_COOKIE['api_token'] ?? null;

        if (!$token) {
            return response()->json(['erro' => 'Não autorizado'], 400);
        }

        $valid = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'senha' => 'nullable|min:8',
        ]);

        $client = new Client();

        $url = env("API_URL");

        $return = $client->post($url."/edita-cadastro", [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ],
            'json' => $valid,
        ]);

        $body = json_decode($return->getBody(), true);

        if($body["logout"]){
            return redirect()->route("logout");
        }

        return redirect()->route("meuCadastro");

    }
}
