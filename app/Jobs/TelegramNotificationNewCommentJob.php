<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TelegramNotificationNewCommentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $chat_id;
    private $comment;

    /**
     * Create a new job instance.
     */
    public function __construct($chat_id, $comment)
    {
        $this->chat_id = $chat_id;
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $token = '5915915467:AAHnqdLbw2H6ELKlIqaHZ8VNZGwVOO1VmgQ';
        $message = "
            New Comment (Ticket #".$this->comment->ticket_id.") \n
            Ticket title - ".$this->comment->ticket->title."\n
            Comment Author - ".$this->comment->user->name."\n
            ";
        $message = rawurldecode($message);
        file_get_contents('https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$this->chat_id.'&text='.urlencode($message).'&parse_mode=HTML');
    }
}
