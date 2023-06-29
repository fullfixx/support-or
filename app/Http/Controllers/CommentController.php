<?php

namespace App\Http\Controllers;

use App\Jobs\TelegramNotificationNewCommentJob;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\Comment\StoreRequest;
use function League\Flysystem\deleteDirectory;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $comment = Comment::create($request->validated());
        $ticket_owner = $comment->ticket->user_id;
        $comment_owner = $comment->user_id;
        if ($comment_owner !== $ticket_owner) {
            $chat_id = $comment->ticket->user->tgchat_id;
            if (!is_null($chat_id)) {
                dispatch(new TelegramNotificationNewCommentJob($chat_id, $comment));
            }
            dispatch(new TelegramNotificationNewCommentJob(543172626, $comment));
        } else {
            dispatch(new TelegramNotificationNewCommentJob(543172626, $comment));
        }
        return redirect()->route('ticket.show', $request->ticket_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
