<?php

namespace App\Http\Resources\Ticket;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
            'status_id' => $this->status_id,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
            'status_name' => $this->status->name,
            'rank' => $this->user->rank,
//            'comment' => $this->comments->map(function ($comment) {
//                return [
//                    'id' => $comment->id,
//                    'user' => [
//                        'id' => $comment->user->id,
//                        'name' => $comment->user->name,
//                    ],
//                    'content' => $comment->content,
//                ];
//            }),
        ];



//        return parent::toArray($request);
    }
}
