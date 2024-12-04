<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeoModuleResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'page' => $this->page,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'is_show' => $this->is_show,

        ];
    }
}
