<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TelegramNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $chat_id;

    /**
     * Create a new job instance.
     */
    public function __construct($chat_id)
    {
        $this->chat_id = $chat_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $token = '5915915467:AAHnqdLbw2H6ELKlIqaHZ8VNZGwVOO1VmgQ';
//        $this->chat_id = '543172626';
        $message = "New Ticket!";
        file_get_contents('https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$this->chat_id.'&text='.urlencode($message));

    }
}
