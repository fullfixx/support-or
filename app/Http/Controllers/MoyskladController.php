<?php

namespace App\Http\Controllers;

use App\Http\Resources\Moysklad\MoyskladResource;
use App\Jobs\MoyskladExchangeJob;
use App\Models\Moysklad;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class MoyskladController extends Controller
{
    /*
     *  Import all assortment
     */
    public function import()
    {
        $entity = 'entity/assortment?';
        $filter = 'filter=type='.urlencode("product");

        dispatch(new MoyskladExchangeJob($entity,$filter));

        return redirect()->route('ticket.index');
    }

    /*
     *  Show all assortment
     */
    public function index()
    {
        $moysklads = Moysklad::query()
            ->when(Request::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            })
            ->orderBy('updated', 'desc')
            ->paginate(25)
            ->withQueryString();

        $moysklads = MoyskladResource::collection($moysklads);
        $filters = Request::only('search');

        return Inertia::render('Moysklad/Index', compact('moysklads', 'filters'));
    }

    /*
     *  Store new customer order
     */
    public function store()
    {
        $organization = '3d9fdc2f-f427-11ea-0a80-00fe000aff0c'; // ELECTRIC MOBILE SL
        $customer = '721ca9f8-04b2-11ee-0a80-06eb0017c661'; // Test legal customer
        $entity = 'entity/customerorder';
        $client = new Client([
            'base_uri' => 'https://online.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => [
                'Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06",
                'Content-Type' => 'application/json',
            ],
            'body' => '{
            "organization": {
              "meta": {
                "href": "https://online.moysklad.ru/api/remap/1.2/entity/organization/'.$organization.'",
                "type": "organization",
                "mediaType": "application/json"
              }
            },
            "agent": {
              "meta": {
                "href": "https://online.moysklad.ru/api/remap/1.2/entity/counterparty/'.$customer.'",
                "type": "counterparty",
                "mediaType": "application/json"
              }
            }
          }'
        ]);

        $response = $client->request('POST', $entity);
        dd($response->getStatusCode());

    }

    /*
     * Load all customer orders
     */
    public function test()
    {
        $client = new Client([
            'base_uri' => 'https://online.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => [
                'Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06",
            ]
        ]);

        $entity = 'entity/customerorder';
        $response = $client->request('GET', $entity);
        $body = $response->getBody();
        $jsonData = json_decode($body->getContents(), true);
        foreach ($jsonData['rows'] as $row) {
            dd($row);
        }
    }
}
