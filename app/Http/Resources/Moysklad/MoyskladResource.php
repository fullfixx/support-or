<?php

namespace App\Http\Resources\Moysklad;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MoyskladResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->ms_id,
            'name' => $this->name,
            'code' => $this->code,
            'stock' => $this->stock,
            'reserve' => $this->reserve,
            'inTransit' => $this->inTransit,
            'quantity' => $this->quantity,
        ];
    }
}
