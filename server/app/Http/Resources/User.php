<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Image;

class User extends JsonResource
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
            'roles'         => $this->roles,
            'id'            => $this->id,
            'organization'  => $this->organization,
            'image'         => Image::find($this->image_id),
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'email'         => $this->email,
            'contact_phone' => $this->contact_phone,
            'username'      => $this->username,
        ];
    }
}
