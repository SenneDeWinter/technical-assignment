<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'previewImage' => $this['thumbnail'],
            'title' => $this['title'],
            'quantity' => $this['quantity'],
            'marvelId' => $this['marvel_id'],
        ];
    }
}
