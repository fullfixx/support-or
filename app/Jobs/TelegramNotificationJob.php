<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use function Symfony\Component\String\toString;

class TelegramNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $chat_id;
    protected $ticket;

    /**
     * Create a new job instance.
     */
    public function __construct($chat_id, $ticket)
    {
        $this->chat_id = $chat_id;
        $this->ticket = $ticket;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $token = '5915915467:AAHnqdLbw2H6ELKlIqaHZ8VNZGwVOO1VmgQ';
        $message = "
        New Ticket! \n
        Title - ".$this->ticket->title."\n
        Author - ".$this->ticket->user->name."\n
        Priority - ".$this->ticket->priority."
        ";
        file_get_contents('https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$this->chat_id.'&text='.urlencode($message).'&parse_mode=HTML');

    }
}
