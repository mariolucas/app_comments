<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;

class AuthWebController extends Controller
{
    public function logout(Request $request)
    {
        $token = $_COOKIE['api_token'];

        $client = new Client();
        $api_url = env('API_URL');
        $res = $client->request('POST', $api_url.'/logout',  [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Bearer " . $token,
            ],
        ]);

        Cookie::queue(Cookie::forget('api_token'));

        return redirect('/');

    }
}
