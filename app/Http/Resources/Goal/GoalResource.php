<?php

namespace App\Http\Resources\Goal;

use App\Http\Resources\Task\TaskResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GoalResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'deadline' => Carbon::parse($this->deadline)->format('d F Y'),
            'tasks' => TaskResource::collection($this->tasks),
        ];
    }
}
