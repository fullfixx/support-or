<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MoyskladController extends Controller
{
    public function index()
    {
        $client = new Client([
            'base_uri' => 'https://online.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => ['Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06"]
        ]);
        $response = $client->request('GET', 'entity/product/8c20ea13-f5e4-11ed-0a80-0cdd00025b43');
        $body = $response->getBody();
        $jsonData = json_decode($body->getContents(), true);
        dd($jsonData['name']);
    }
}
