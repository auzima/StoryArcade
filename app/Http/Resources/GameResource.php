<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'version' => $this->version,
            'is_published' => $this->is_published,
            'scenes_count' => $this->whenCounted('scenes'),
            'choices_count' => $this->whenCounted('choices'),
            'author' => $this->when(isset($this->user), function () {
                return [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                ];
            }),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'scenes' => SceneResource::collection($this->whenLoaded('scenes')),
        ];
    }
}
