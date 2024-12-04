<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

class JwtWebMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $_COOKIE['api_token'] ?? null;

        if (!$token) {
            return redirect()->route('login')->withErrors('Acesso não autorizado.');
        }

        $client = new Client();
        
        try {

            $api_url = env('API_URL');

            $res = $client->request('GET', $api_url.'/valida-token', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => "Bearer " . $token,
                ],
            ]);

            $data = json_decode($res->getBody()->getContents(), true);

            if (!isset($data['valid']) || !$data['valid']) {
                return redirect()->route('login')->withErrors('Sessão inválida.');
            }

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $errorResponse = json_decode($e->getResponse()->getBody()->getContents(), true);
                $errorMessage = $errorResponse['message'] ?? 'Erro ao validar a sessão.';
            } else {
                $errorMessage = 'Erro de conexão com o servidor.';
            }

            return redirect()->route('login')->withErrors($errorMessage);
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors('Ocorreu um erro inesperado.');
        }

        return $next($request);
    }
}
