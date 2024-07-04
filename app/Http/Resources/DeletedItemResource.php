<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeletedItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'marvelId' => $this->marvel_id,
            'title' => $this->title,
            'timesDeleted' => $this->times_deleted,
        ];
    }
}
