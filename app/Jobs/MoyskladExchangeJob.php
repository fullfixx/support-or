<?php

namespace App\Jobs;

use App\Models\Moysklad;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MoyskladExchangeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $entity;
    private $filter;

    /**
     * Create a new job instance.
     */
    public function __construct($entity,$filter)
    {
        //
        $this->entity = $entity;
        $this->filter = $filter;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $client = new Client([
            'base_uri' => 'https://online.moysklad.ru/api/remap/1.2/',
            'timeout'  => 10.0,
            'headers' => ['Authorization' => "Bearer f210315458e7173f6b67743fc847ffd36c1cba06"]
        ]);
        $response = $client->request('GET', $this->entity.$this->filter);
        $body = $response->getBody();
        $jsonData = json_decode($body->getContents(), true);
        foreach ($jsonData['rows'] as $row) {
            if (isset($row['code'])) {
                Moysklad::firstOrCreate([
                    'name' => $row['name']
                ],[
                    'ms_id' => $row['id'],
                    'updated' => $row['updated'],
                    'name' => $row['name'],
                    'code' => $row['code'],
                    'externalCode' => $row['externalCode'],
                    'stock' => $row['stock'],
                    'reserve' => $row['reserve'],
                    'inTransit' => $row['inTransit'],
                    'quantity' => $row['quantity'],
                ]);
            } else {
                Moysklad::firstOrCreate([
                    'name' => $row['name']
                ],[
                    'ms_id' => $row['id'],
                    'updated' => $row['updated'],
                    'name' => $row['name'],
                    'code' => 'Not defined',
                    'externalCode' => $row['externalCode'],
                    'stock' => $row['stock'],
                    'reserve' => $row['reserve'],
                    'inTransit' => $row['inTransit'],
                    'quantity' => $row['quantity'],
                ]);
            }
//            echo $row['name']."<br />";
        }
    }
}
