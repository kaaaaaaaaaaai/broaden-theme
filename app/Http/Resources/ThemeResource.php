<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ThemeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'images' => $this->image,
            'scene' => $this->scene,
            'product' => $this->product,
            'character_text' => $this->character_text,
            'created_at' => $this->created_at->format("Y-m-d h:m:i"),
            'updated_at' => $this->updated_at->format("Y-m-d h:m:i")
        ];
    }
}
