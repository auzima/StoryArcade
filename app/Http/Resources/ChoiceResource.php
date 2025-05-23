<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChoiceResource extends JsonResource
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
            'text' => $this->text,
            'scene_id' => $this->scene_id,
            'next_scene_id' => $this->next_scene_id,
            'order' => $this->order,
            'scene' => new SceneResource($this->whenLoaded('scene')),
            'next_scene' => new SceneResource($this->whenLoaded('nextScene')),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
