<?php

namespace App\Http\Resources\Goal;

use App\Http\Resources\Task\TaskResource;
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
//            'tasks' => $this->tasks->map(function ($task) {
//                return [
//                    'id' => $task->id,
//                    'name' => $task->name,
//                ];
//            }),
            'tasks' => TaskResource::collection($this->tasks),
        ];
    }
}
