<?php

namespace App\Imports;

use Carbon\Carbon;
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
            if (isset($item[5]) && $item[5] != null && $item[1] != null && $item[1] != 'Type' && Str::contains($item[2], ['VALSTS', 'PVN', 'Own Account', 'mezhdu']) != true) {
                if (Str::contains($item[1], ['FEE'])) {
                    $expenseitem = 'a61b4039-0b08-11eb-0a80-03b80015b1d2';
                    $expenseitemdesc = 'Комиссия банка';
                    $agent = '8d937ff4-0b08-11eb-0a80-04a500196a31'; // Банк
                } elseif (Str::contains($item[1], ['COMMISSION'])) {
                    $expenseitem = 'ab9c6412-03dc-11eb-0a80-04ea000a635e';
                    $expenseitemdesc = 'Платежные системы';
                    $agent = 'dbfc086b-b443-11ee-0a80-02a60013b19e'; // Payment Systems
                } elseif (Str::contains($item[1], ['CHARGES']) or Str::contains($item[2], ['SkyOffice', 'BITE', 'TELE2', 'returned goods', 'Hostinger', 'CRMPERKS', 'AAS BALTA', 'Clean R', 'Omfy'])) {
                    $expenseitem = 'ad104350-a524-11ec-0a80-02f8000de832';
                    $expenseitemdesc = 'Прочее';
                    if (Str::contains($item[1], ['CHARGES'])) {
                        $agent = '0825123e-b444-11ee-0a80-103600141c4a'; // Charges
                    } elseif (Str::contains($item[2], 'SkyOffice')) {
                        $agent = 'cef5ff46-b444-11ee-0a80-02a60013ec13'; // SkyOffice
                    } elseif (Str::contains($item[2], 'BITE')) {
                        $agent = '02dcf178-b445-11ee-0a80-0d3c00142572'; // BITE
                    } elseif (Str::contains($item[2], 'TELE2')) {
                        $agent = '0cbefefd-b445-11ee-0a80-02a60013f9bb'; // TELE2
                    } elseif (Str::contains($item[2], 'returned goods')) {
                        $agent = '95a8acf4-b445-11ee-0a80-0ea80013b647'; // Возврат товара
                    } elseif (Str::contains($item[2], 'Hostinger')) {
                        $agent = 'cb850000-b445-11ee-0a80-0671001385ad'; // Hostinger
                    } elseif (Str::contains($item[2], 'CRMPERKS')) {
                        $agent = 'd3ff2388-b445-11ee-0a80-06710013870e'; // CRMPERKS
                    } elseif (Str::contains($item[2], 'AAS BALTA')) {
                        $agent = 'dcb8fcdb-b445-11ee-0a80-067100138886'; // AAS BALTA
                    } elseif (Str::contains($item[2], 'Clean R')) {
                        $agent = 'e46239a7-b445-11ee-0a80-0c8e001390ce'; // Clean R
                    } elseif (Str::contains($item[2], 'Omfy')) {
                        $agent = 'ec6db18b-b445-11ee-0a80-08ec00140655'; // Omfy
                    }
                } elseif (Str::contains($item[2], ['RABEN LATVIA SIA', 'Itella', 'TNT', 'Omniva', 'A-ES LOGISTICS', 'DPD', 'DHL', 'EKL', 'PASTS', 'Envato'])) {
                    $expenseitem = '0c1c6e44-03ec-11eb-0a80-037a000ca88b';
                    $expenseitemdesc = 'Доставка';
                    if (Str::contains($item[2], 'RABEN LATVIA SIA')) {
                        $agent = '288027a5-b444-11ee-0a80-03330013e465'; // Raben
                    } elseif (Str::contains($item[2], 'Itella')) {
                        $agent = '3787aff4-b444-11ee-0a80-03330013e899'; // Itella
                    } elseif (Str::contains($item[2], 'TNT')) {
                        $agent = '52d5ca2b-b444-11ee-0a80-0ea8001378b6'; // TNT
                    } elseif (Str::contains($item[2], 'Omniva')) {
                        $agent = 'd913986e-b444-11ee-0a80-067100135d4b'; // Omniva
                    } elseif (Str::contains($item[2], 'A-ES LOGISTICS')) {
                        $agent = '233e685d-b445-11ee-0a80-08ec0013daa0'; // A-ES LOGISTICS
                    } elseif (Str::contains($item[2], 'DPD')) {
                        $agent = '206f843d-03df-11eb-0a80-098b000ac751'; // DPD
                    } elseif (Str::contains($item[2], 'DHL')) {
                        $agent = '2ab09b1d-b445-11ee-0a80-1036001475b1'; // DHL
                    } elseif (Str::contains($item[2], 'EKL')) {
                        $agent = '32420de8-b445-11ee-0a80-103600147728'; // EKL
                    } elseif (Str::contains($item[2], 'PASTS')) {
                        $agent = '441bad99-b445-11ee-0a80-16e500141256'; // PASTS
                    } elseif (Str::contains($item[2], 'Envato')) {
                        $agent = '582de0d7-b445-11ee-0a80-0333001426ef'; // Envato
                    }
                } elseif (Str::contains($item[2], ['ija Bre', 'Karina', 'Darba alga'])) {
                    $expenseitem = '6d0a53d8-a522-11ec-0a80-033c000d69e0';
                    $expenseitemdesc = 'ФОТ';
                    if (Str::contains($item[2], 'ija Bre')) {
                        $agent = 'e113ec37-b444-11ee-0a80-17360013cc36'; // Julia Brecs
                    } elseif (Str::contains($item[2], 'Karina')) {
                        $agent = 'fa90f774-b444-11ee-0a80-02a60013f680'; // Karina Udodova
                    } elseif (Str::contains($item[2], 'Darba alga')) {
                        $agent = 'adc76e81-b445-11ee-0a80-0ea80013bb99'; // Darba alga
                    }
                } elseif (Str::contains($item[2], ['Izaka', 'J.IZAKAS'])) {
                    $expenseitem = '71ccd4cd-944d-11ee-0a80-0e9600172c15';
                    $expenseitemdesc = 'Бухгалтерия';
                    $agent = 'ea756f5a-b444-11ee-0a80-08ec0013cfc6'; // Izaka
                } elseif (Str::contains($item[2], ['Top Media', 'Mix Max', 'GOOGLE', 'PAPER SEAL', 'GoogleAdwordsEU'])) {
                    $expenseitem = 'c84dade4-badf-11ea-0a80-00dd000ec9a7';
                    $expenseitemdesc = 'Маркетинг и реклама';
                    if (Str::contains($item[2], 'Top Media')) {
                        $agent = 'f21d0faf-b444-11ee-0a80-16e500140593'; // Top Media
                    } elseif (Str::contains($item[2], 'Mix Max')) {
                        $agent = '13e540f9-b445-11ee-0a80-00750014262d'; // Mix Max
                    } elseif (Str::contains($item[2], ['GOOGLE', 'GoogleAdwordsEU'])) {
                        $agent = '4f44b39a-b445-11ee-0a80-007500143015'; // GOOGLE
                    } elseif (Str::contains($item[2], 'PAPER')) {
                        $agent = '60ca0e6b-b445-11ee-0a80-17360013e3c8'; // PAPER SEAL
                    }
                } elseif (Str::contains($item[2], ['Pakingas', 'BOX', 'Sentipacks', 'Antalis AS'])) {
                    $expenseitem = '9e8f73ef-9450-11ee-0a80-09d9001792c2';
                    $expenseitemdesc = 'Материалы';
                    if (Str::contains($item[2], 'Pakingas')) {
                        $agent = '1baf6f0d-b445-11ee-0a80-08ec0013d8f4'; // Pakingas
                    } elseif (Str::contains($item[2], 'BOX')) {
                        $agent = '3953e260-b445-11ee-0a80-04420013c0d8'; // BOX
                    } elseif (Str::contains($item[2], 'Sentipacks')) {
                        $agent = 'c472e19a-b445-11ee-0a80-0333001439e5'; // Sentipacks
                    } elseif (Str::contains($item[2], 'Antalis AS')) {
                        $agent = 'f3eede10-b445-11ee-0a80-0ea80013c840'; // Antalis AS
                    }
                } elseif (Str::contains($item[2], ['MOG'])) {
                    $expenseitem = 'a1a6e894-adae-11eb-0a80-0538000f64e4';
                    $expenseitemdesc = 'Таможня';
                    $agent = '89feffd3-adae-11eb-0a80-0876000ef1b8'; // Таможенный брокер
                } elseif (Str::contains($item[2], ['Altum'])) {
                    $expenseitem = 'e3e65428-944f-11ee-0a80-109f00175e8c';
                    $expenseitemdesc = 'Кредит';
                    $agent = '7028e63f-b445-11ee-0a80-08ec0013f128'; // Altum
                } elseif (Str::contains($item[2], ['GOLDCAR', 'ESTUDIO'])) {
                    $expenseitem = 'e1aa1860-82fe-11ed-0a80-0ec6002ec92b';
                    $expenseitemdesc = 'Испания';
                    if (Str::contains($item[2], 'GOLDCAR')) {
                        $agent = '8c2cd772-b445-11ee-0a80-02a6001413c1'; // Goldcar
                    } elseif (Str::contains($item[2], 'ESTUDIO')) {
                        $agent = 'bc7b099b-b445-11ee-0a80-17360013f346'; // ESTUDIO
                    }
                } elseif (Str::contains($item[2], ['Kuzmina', 'aizdevuma atgriesana'])) {
                    $expenseitem = '0b1b58a9-af00-11ee-0a80-0b8400859dad';
                    $expenseitemdesc = 'Затраты по выписке';
                    if (Str::contains($item[2], 'Kuzmina')) {
                        $agent = '9dc0d29b-b445-11ee-0a80-0c8e0013794d'; // Kuzmina
                    } elseif (Str::contains($item[2], 'aizdevuma atgriesana')) {
                        $agent = 'a68932ca-b445-11ee-0a80-17360013efc4'; // Aizdevuma atgriesana
                    }
                } elseif (Str::contains($item[2], ['VALSTS', 'PVN'])) {
                    $expenseitem = '8dcf6506-0a01-11e4-835f-002590a32f46';
                    $expenseitemdesc = 'Налоги и сборы';
                    $agent = '1c79dc7f-b444-11ee-0a80-067100132047'; // Valsts
                }

                if (!isset($expenseitem)) {
                    $expenseitem = '15108be1-b45c-11ee-0a80-08ec0019a753';
                    $expenseitemdesc = 'The Unknown Robot';
                }

                if (!isset($agent)) {
                    $agent = 'a4abfdc9-b459-11ee-0a80-08ec00191da1'; // The Unknown Robot
                }

                $i = $i+1;

                if ($i > 0) {
                    $moment = Carbon::createFromFormat('d.m.y', $item[0])->format('Y-m-d H:i:s');
                    $paymentPurpose = preg_replace('/["\r\n","\r","\n"]+/', '. ', $item[2]);
                    $sum = $item[5]*100;
                    $organization = '3d9fdc2f-f427-11ea-0a80-00fe000aff0c'; // "SIA "Viensrats.lv"
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
               "moment": "'.$moment.'",
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

                    $response = $client->request('POST', $entity, ['connect_timeout' => 15]);
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
              "moment": "'.$moment.'",
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

                    $response = $client->request('POST', $entity, ['connect_timeout' => 15]);
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

                    $response = $client->request('POST', $entity, ['connect_timeout' => 15]);
                    dump($i.' value: '.$item[5].' status '.$response->getStatusCode());
//                die();
                }
//                api-request finish

            }
        }
    }
}
