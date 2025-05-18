<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SceneResource extends JsonResource
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
            'content' => $this->content,
            'image' => $this->when(isset($this->image), function () {
                return asset('storage/' . $this->image);
            }),
            'order' => $this->order,
            'game_id' => $this->game_id,
            'choices_count' => $this->whenCounted('choices'),
            'choices' => ChoiceResource::collection($this->whenLoaded('choices')),
            'game' => new GameResource($this->whenLoaded('game')),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
