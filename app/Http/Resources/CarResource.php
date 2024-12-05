<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "model" => $this->model,
            "brand"=> $this->brand,
            "year"=> $this->year,
            "created_at"=> $this->created_at,
        ];
    }
}
