<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'      => (string) $this->name,
            'slug'      => (string) ($this->slug ?? Str::slug($this->name)),
            'description' => (string) ($this->description ?? ''),
            'photo'     => $this->when($this->parent_id == 0, fn() => $this->photo ?? ''),
            'children'  => $this->whenLoaded('subcategories',
                fn() => CategoryResource::collection($this->subcategories)
            ),
        ];
    }
}
