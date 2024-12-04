<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ObjectResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'status' => $this->status,
            'description' => $this->description,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'project' => ProjectResource::make($this->project)
        ];
    }
}
