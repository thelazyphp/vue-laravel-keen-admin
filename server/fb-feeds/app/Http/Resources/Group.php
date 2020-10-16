<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Group extends JsonResource
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
            'category' => $this->category,
            'parsing' => $this->parsing,
            'active' => $this->active,
            'public' => $this->public,
            'name' => $this->name,
            'url' => $this->url,
            'image' => $this->image,
            'description' => $this->description,
            'last_time_parsed_at' => $this->last_time_parsed_at,
        ];
    }
}
