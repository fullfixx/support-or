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

    /*
     *  Получить все статьи расходов
     */
    public function expenseitems()
    {
        $client = new Client([
            'base_uri' => 'https://api.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => [
                'Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06",
                'Accept-Encoding' => 'gzip',
            ]
        ]);

        $entity = 'entity/expenseitem';
        $response = $client->request('GET', $entity);
        $body = $response->getBody();
        $jsonData = json_decode($body->getContents(), true);
        foreach ($jsonData['rows'] as $row) {
            dump($row);
        }
    }

    /*
     *  Получить контрагентов
     */
    public function counteragents()
    {
        $client = new Client([
            'base_uri' => 'https://api.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => [
                'Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06",
                'Accept-Encoding' => 'gzip',
            ]
        ]);

        $entity = 'entity/counterparty';
        $filter = '?filter=name='.urlencode("Таможенный брокер");
        $response = $client->request('GET', $entity.$filter);
        $body = $response->getBody();
        $jsonData = json_decode($body->getContents(), true);
        foreach ($jsonData['rows'] as $row) {
            dd($row);
        }
    }

    /*
     *  Получить юр.лица
     */
    public function organization()
    {
        $client = new Client([
            'base_uri' => 'https://api.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => [
                'Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06",
                'Accept-Encoding' => 'gzip',
            ]
        ]);

        $entity = 'entity/organization';
        $response = $client->request('GET', $entity);
        $body = $response->getBody();
        $jsonData = json_decode($body->getContents(), true);
        foreach ($jsonData['rows'] as $row) {
            dump($row);
        }
    }

    /*
     *  Получить список счетов юр.лица
     */
    public function accounts()
    {
        $client = new Client([
            'base_uri' => 'https://api.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => [
                'Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06",
                'Accept-Encoding' => 'gzip',
            ]
        ]);

        $organization_id = '3d9fdc2f-f427-11ea-0a80-00fe000aff0c'; // Viensrats.lv
//        $organization_id = 'c845f0a2-badf-11ea-0a80-00dd000ec99b'; // ELECTRIC MOBILE SL
        $entity = 'entity/organization/'.$organization_id.'/accounts';
        $response = $client->request('GET', $entity);
        $body = $response->getBody();
        $jsonData = json_decode($body->getContents(), true);
        foreach ($jsonData['rows'] as $row) {
            dump($row);
        }
    }

    /*
     *  Получить Валюты
     */
    public function currency()
    {
        $client = new Client([
            'base_uri' => 'https://api.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => [
                'Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06",
                'Accept-Encoding' => 'gzip',
            ]
        ]);

        $entity = 'entity/currency/';
        $response = $client->request('GET', $entity);
        $body = $response->getBody();
        $jsonData = json_decode($body->getContents(), true);
        foreach ($jsonData['rows'] as $row) {
            dump($row);
        }
    }

    /*
     *  Получить исходящий платеж
     */
    public function paymentoutShow()
    {
        $client = new Client([
            'base_uri' => 'https://api.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => [
                'Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06",
                'Accept-Encoding' => 'gzip',
            ]
        ]);

        $entity = 'entity/paymentout';
        $filter = '?filter=name='.urlencode("77777001");
        $response = $client->request('GET', $entity.$filter);
        $body = $response->getBody();
        $jsonData = json_decode($body->getContents(), true);
        dump($jsonData);
    }

    /*
     *  Получить Приемку
     */
    public function supply()
    {
        $client = new Client([
            'base_uri' => 'https://api.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => [
                'Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06",
                'Accept-Encoding' => 'gzip',
            ]
        ]);

        $entity = 'entity/supply';
        $filter = '?filter=name='.urlencode("777007");
        $response = $client->request('GET', $entity.$filter);
        $body = $response->getBody();
        $jsonData = json_decode($body->getContents(), true);
        foreach ($jsonData['rows'] as $row) {
            dump($row);
        }
    }

    /*
     *  Получить позиции Приемки
     */
    public function supplyPositions()
    {
        $client = new Client([
            'base_uri' => 'https://api.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => [
                'Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06",
                'Accept-Encoding' => 'gzip',
            ]
        ]);

        $supply = '744c1ac1-d7a8-11ed-0a80-05b500375aec';
        $entity = 'entity/supply/'.$supply.'/positions';
        $response = $client->request('GET', $entity);
        $body = $response->getBody();
        $jsonData = json_decode($body->getContents(), true);
        dump($jsonData);

    }

    /*
     *  Создать Приемку
     */
    public function supplyStore()
    {
        $organization = '3d9fdc2f-f427-11ea-0a80-00fe000aff0c'; // "SIA "Viensrats.lv"
        $agent = 'b91fd61b-0428-11eb-0a80-04f10001aaa6'; // "PayPal"
        $store = 'c84788bb-badf-11ea-0a80-00dd000ec99d';
        $paymentout = 'e5e011ac-a987-11ee-0a80-0286009e4c5c';

        $entity = 'entity/supply';
        $client = new Client([
            'base_uri' => 'https://api.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => [
                'Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06",
                'Content-Type' => 'application/json',
                'Accept-Encoding' => 'gzip',
            ],
            'body' => '{
               "name":"777013",
               "description":"робот",
               "moment":"2024-01-02 15:01:02",
               "applicable":true,
               "vatEnabled":true,
               "vatIncluded":true,
               "rate":{
                  "currency":{
                     "meta":{
                        "href":"https://api.moysklad.ru/api/remap/1.2/entity/currency/c847acf8-badf-11ea-0a80-00dd000ec9a2",
                        "metadataHref":"https://api.moysklad.ru/api/remap/1.2/entity/currency/metadata",
                        "type":"currency",
                        "mediaType":"application/json"
                     }
                  },
                  "value":1
               },
               "organization":{
                  "meta":{
                     "href":"https://api.moysklad.ru/api/remap/1.2/entity/organization/'.$organization.'",
                     "metadataHref":"https://api.moysklad.ru/api/remap/1.2/entity/organization/metadata",
                     "type":"organization",
                     "mediaType":"application/json"
                  }
               },
               "agent":{
                  "meta":{
                     "href":"https://api.moysklad.ru/api/remap/1.2/entity/counterparty/'.$agent.'",
                     "metadataHref":"https://api.moysklad.ru/api/remap/1.2/entity/counterparty/metadata",
                     "type":"counterparty",
                     "mediaType":"application/json"
                  }
               },
               "store":{
                  "meta":{
                     "href":"https://api.moysklad.ru/api/remap/1.2/entity/store/'.$store.'",
                     "metadataHref":"https://api.moysklad.ru/api/remap/1.2/entity/store/metadata",
                     "type":"store",
                     "mediaType":"application/json"
                  }
               },
               "positions":[
                  {
                     "quantity":1,
                     "price":7700,
                     "discount":0,
                     "vat":0,
                     "assortment":{
                        "meta":{
                           "href":"https://api.moysklad.ru/api/remap/1.2/entity/service/d113363f-03dc-11eb-0a80-098b000a6134",
                           "metadataHref":"https://api.moysklad.ru/api/remap/1.2/entity/product/metadata",
                           "type":"service",
                           "mediaType":"application/json",
                           "uuidHref":"https://online.moysklad.ru/app/#good/edit?id=d113286d-03dc-11eb-0a80-098b000a6132"
                        }
                     },
                     "overhead":0
                  }
               ]
            }'
        ]);

        $response = $client->request('POST', $entity);
        $content = json_decode($response->getBody()->getContents());
        dd($content);
    }

    /*
     *  Создать исходящий платеж
     */
    public function paymentoutStore()
    {
        $organization = '3d9fdc2f-f427-11ea-0a80-00fe000aff0c'; // "SIA "Viensrats.lv"
        $agent = 'b91fd61b-0428-11eb-0a80-04f10001aaa6'; // "PayPal"
        $expenseitem = 'a61b4039-0b08-11eb-0a80-03b80015b1d2'; // "Комиссия банка"

        $entity = 'entity/paymentout';
        $client = new Client([
            'base_uri' => 'https://api.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => [
                'Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06",
                'Content-Type' => 'application/json',
                'Accept-Encoding' => 'gzip',
            ],
            'body' => '{
              "paymentPurpose": "bla bla bla",
              "organization": {
                "meta": {
                  "href": "https://api.moysklad.ru/api/remap/1.2/entity/organization/'.$organization.'",
                  "metadataHref": "https://api.moysklad.ru/api/remap/1.2/entity/organization/metadata",
                  "type": "organization",
                  "mediaType": "application/json"
                }
              },
              "agent": {
                "meta": {
                  "href": "https://api.moysklad.ru/api/remap/1.2/entity/counterparty/'.$agent.'",
                  "metadataHref": "https://api.moysklad.ru/api/remap/1.2/entity/counterparty/metadata",
                  "type": "counterparty",
                  "mediaType": "application/json"
                }
              },
              "expenseItem": {
                "meta": {
                  "href": "https://api.moysklad.ru/api/remap/1.2/entity/expenseitem/'.$expenseitem.'",
                  "metadataHref": "https://api.moysklad.ru/api/remap/1.2/entity/expenseitem/metadata",
                  "type": "expenseitem",
                  "mediaType": "application/json"
                }
              },
              "sum": 7700,
          }'
        ]);

        $response = $client->request('POST', $entity);
        $content = json_decode($response->getBody()->getContents());
        dd($content);
    }

    /*
     *  Изменить исходящий платеж
     */
    public function paymentoutEdit()
    {
        $paymentout = 'd3049e43-aa30-11ee-0a80-0e8f00b4cfd9';
        $supply = 'f8e05424-aa30-11ee-0a80-0f0f00b5152e';

        $entity = 'entity/paymentout';
        $client = new Client([
            'base_uri' => 'https://api.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => [
                'Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06",
                'Content-Type' => 'application/json',
                'Accept-Encoding' => 'gzip',
            ],
            'body' => '[
                {
                    "meta": {
                        "href": "https://api.moysklad.ru/api/remap/1.2/entity/paymentout/'.$paymentout.'",
                        "metadataHref": "https://api.moysklad.ru/api/remap/1.2/entity/paymentout/metadata",
                        "type": "paymentout",
                        "mediaType": "application/json"
                      },
                      "name": "91923",
                      "operations": [
                        {
                            "meta": {
                                "href": "https://api.moysklad.ru/api/remap/1.2/entity/supply/'.$supply.'",
                                "type": "supply"
                            },
                            "linkedSum": 7700
                        }
                      ]

                }
            ]'
        ]);

        $response = $client->request('POST', $entity);
        $content = json_decode($response->getBody()->getContents());
        dd($content);
    }

    /*
     *  Завести statement (полная операция)
     */
    public function statementinsert()
    {
        $organization = '3d9fdc2f-f427-11ea-0a80-00fe000aff0c'; // "SIA "Viensrats.lv"
        $agent = 'b91fd61b-0428-11eb-0a80-04f10001aaa6'; // "PayPal"
        $store = 'c84788bb-badf-11ea-0a80-00dd000ec99d';
        $entity = 'entity/supply';
        $client = new Client([
            'base_uri' => 'https://api.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => [
                'Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06",
                'Content-Type' => 'application/json',
                'Accept-Encoding' => 'gzip',
            ],
            'body' => '{
               "description":"робот",
               "applicable":true,
               "vatEnabled":true,
               "vatIncluded":true,
               "rate":{
                  "currency":{
                     "meta":{
                        "href":"https://api.moysklad.ru/api/remap/1.2/entity/currency/c847acf8-badf-11ea-0a80-00dd000ec9a2",
                        "metadataHref":"https://api.moysklad.ru/api/remap/1.2/entity/currency/metadata",
                        "type":"currency",
                        "mediaType":"application/json"
                     }
                  },
                  "value":1
               },
               "organization":{
                  "meta":{
                     "href":"https://api.moysklad.ru/api/remap/1.2/entity/organization/'.$organization.'",
                     "metadataHref":"https://api.moysklad.ru/api/remap/1.2/entity/organization/metadata",
                     "type":"organization",
                     "mediaType":"application/json"
                  }
               },
               "agent":{
                  "meta":{
                     "href":"https://api.moysklad.ru/api/remap/1.2/entity/counterparty/'.$agent.'",
                     "metadataHref":"https://api.moysklad.ru/api/remap/1.2/entity/counterparty/metadata",
                     "type":"counterparty",
                     "mediaType":"application/json"
                  }
               },
               "store":{
                  "meta":{
                     "href":"https://api.moysklad.ru/api/remap/1.2/entity/store/'.$store.'",
                     "metadataHref":"https://api.moysklad.ru/api/remap/1.2/entity/store/metadata",
                     "type":"store",
                     "mediaType":"application/json"
                  }
               },
               "positions":[
                  {
                     "quantity":1,
                     "price":3000,
                     "discount":0,
                     "vat":0,
                     "assortment":{
                        "meta":{
                           "href":"https://api.moysklad.ru/api/remap/1.2/entity/service/d113363f-03dc-11eb-0a80-098b000a6134",
                           "metadataHref":"https://api.moysklad.ru/api/remap/1.2/entity/product/metadata",
                           "type":"service",
                           "mediaType":"application/json",
                           "uuidHref":"https://online.moysklad.ru/app/#good/edit?id=d113286d-03dc-11eb-0a80-098b000a6132"
                        }
                     },
                     "overhead":0
                  }
               ]
            }'
        ]);

        $response = $client->request('POST', $entity);
        $content = json_decode($response->getBody()->getContents());
        $supply = $content->id;

        $expenseitem = 'a61b4039-0b08-11eb-0a80-03b80015b1d2'; // "Комиссия банка"
        $entity = 'entity/paymentout';
        $client = new Client([
            'base_uri' => 'https://api.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => [
                'Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06",
                'Content-Type' => 'application/json',
                'Accept-Encoding' => 'gzip',
            ],
            'body' => '{
              "description":"робот",
              "paymentPurpose":"text of bla bla bla",
              "organization": {
                "meta": {
                  "href": "https://api.moysklad.ru/api/remap/1.2/entity/organization/'.$organization.'",
                  "metadataHref": "https://api.moysklad.ru/api/remap/1.2/entity/organization/metadata",
                  "type": "organization",
                  "mediaType": "application/json"
                }
              },
              "agent": {
                "meta": {
                  "href": "https://api.moysklad.ru/api/remap/1.2/entity/counterparty/'.$agent.'",
                  "metadataHref": "https://api.moysklad.ru/api/remap/1.2/entity/counterparty/metadata",
                  "type": "counterparty",
                  "mediaType": "application/json"
                }
              },
              "expenseItem": {
                "meta": {
                  "href": "https://api.moysklad.ru/api/remap/1.2/entity/expenseitem/'.$expenseitem.'",
                  "metadataHref": "https://api.moysklad.ru/api/remap/1.2/entity/expenseitem/metadata",
                  "type": "expenseitem",
                  "mediaType": "application/json"
                }
              },
              "sum": 3000
          }'
        ]);

        $response = $client->request('POST', $entity);
        $content = json_decode($response->getBody()->getContents());
        $paymentout = $content->id;

        $entity = 'entity/paymentout';
        $client = new Client([
            'base_uri' => 'https://api.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => [
                'Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06",
                'Content-Type' => 'application/json',
                'Accept-Encoding' => 'gzip',
            ],
            'body' => '[
                {
                    "meta": {
                        "href": "https://api.moysklad.ru/api/remap/1.2/entity/paymentout/'.$paymentout.'",
                        "metadataHref": "https://api.moysklad.ru/api/remap/1.2/entity/paymentout/metadata",
                        "type": "paymentout",
                        "mediaType": "application/json"
                      },
                      "operations": [
                        {
                            "meta": {
                                "href": "https://api.moysklad.ru/api/remap/1.2/entity/supply/'.$supply.'",
                                "type": "supply"
                            },
                            "linkedSum": 3000
                        }
                      ]

                }
            ]'
        ]);

        $response = $client->request('POST', $entity);
        $content = json_decode($response->getBody()->getContents());
        dd($content);
    }

    /*
     *  Создать контрагента
     */
    public function counterpartystore()
    {
        $entity = 'entity/counterparty';
        $client = new Client([
            'base_uri' => 'https://api.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => [
                'Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06",
                'Content-Type' => 'application/json',
                'Accept-Encoding' => 'gzip',
            ],
            'body' => json_encode([
                'name' => 'the Unknown Robot',
            ])
        ]);

        $response = $client->request('POST', $entity);
        $content = json_decode($response->getBody()->getContents());
        print_r($content->id);
        die();
    }

    /*
     *  Создать статью расходов
     */
    public function expenseitemstore()
    {
        $entity = 'entity/expenseitem';
        $client = new Client([
            'base_uri' => 'https://api.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => [
                'Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06",
                'Content-Type' => 'application/json',
                'Accept-Encoding' => 'gzip',
            ],
            'body' => json_encode([
                'name' => 'the Unknown Robot',
            ])
        ]);

        $response = $client->request('POST', $entity);
        $content = json_decode($response->getBody()->getContents());
        print_r($content->id);
        die();
    }

}
