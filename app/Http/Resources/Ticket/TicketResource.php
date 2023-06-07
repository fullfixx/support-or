<?php

namespace App\Http\Resources\Ticket;

use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\File\FileResource;
use Carbon\Carbon;
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
            'deadline_raw' =>$this->deadline,
            'deadline_carbon' => Carbon::parse($this->deadline)->format('d F Y'),
            'status_name' => $this->status->name,
            'rank' => $this->user->rank,
            'comments' => CommentResource::collection($this->comments),
//            'files' => FileResource::collection($this->files),
        ];
    }
}
