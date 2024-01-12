<?php

namespace App\Imports;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;

class StatementsImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $i = 0;
        foreach ($collection as $item) {
            if (isset($item[5]) && $item[5] != null && $item[5] < 3 && $item[1] != null && $item[1] != 'Type') {
                if (Str::contains($item[1], ['FEE', 'COMMISSION FOR PAYMENT PLAN'])) {
                    $expenseitem = 'a61b4039-0b08-11eb-0a80-03b80015b1d2'; // "Комиссия банка"
                } elseif (Str::contains($item[1], ['INSTANT PAYMENT CHARGES'])) {
                    $expenseitem = 'ad104350-a524-11ec-0a80-02f8000de832'; // "Прочее"
                } else {
                    $expenseitem = '8dcf6506-0a01-11e4-835f-002590a32f46'; // "Налоги и сборы"
                }

                $i = $i+1;
//                dump($i.' : '.$item[1].' = '.$item[5].' : '.$expenseitem);
//                dd($i.' : '.$item[1].' = '.$item[5].' : '.$paymentPurpose);

                $paymentPurpose = preg_replace('/["\r\n","\r","\n"]+/', '. ', $item[2]);
                $sum = $item[5]*100;
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
                     "price":'.$sum.',
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
              "description": "робот",
              "paymentPurpose": "'.$paymentPurpose.'",
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
              "sum":'.$sum.'
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
                            "linkedSum": '.$sum.'
                        }
                      ]

                }
            ]'
                ]);

                $response = $client->request('POST', $entity);
                dd($i.': status '.$response->getStatusCode());

            }
        }
    }
}
