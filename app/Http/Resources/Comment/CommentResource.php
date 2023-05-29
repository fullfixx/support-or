<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'ticket_id' => $this->ticket_id,
            'user_name' => $this->user->name,
            'content' => $this->content,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
