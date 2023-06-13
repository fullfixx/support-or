<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PrestashopController extends Controller
{
    public function index()
    {
        $apiKey = 'X148Q8VXAJEMB64Z8KI6Z58PJXZAT5AV';
        $authorizationKey = base64_encode($apiKey . ':');

        $client = new Client([
            'base_uri' => 'https://oneride.xyz/api/',
            'timeout'  => 10.0,
            'headers' => ['Output-Format' => 'JSON', 'Authorization' => "Basic ".$authorizationKey]
        ]);

        $response = $client->request('GET', 'customers/?display=full&limit=5');
        $body = $response-> getBody();
        $jsonData = json_decode($body->getContents(), true);
        dd($jsonData);
    }
}
