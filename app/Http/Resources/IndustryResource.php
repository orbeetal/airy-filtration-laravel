<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class IndustryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 'id'    => $this->id,
            'name'  => $this->name,
            'slug'  => $this->slug ?? Str::slug($this->name),
            'banner'    => $this->when($this->parent_id == 0,
                fn() => $this->image 
                    ? route('industries.streamImage', $this->id) . "?v=" . ($this->updated_at->timestamp ?? time()) 
                    : ""
            ),
            "description"   => $this->whenHas('description', $this->description ?? ""),
        ];
    }
}
