<?php

namespace App\Http\Resources\Datatable;

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
            'id' => $this->id,

            $this->mergeWhen($this->company, [
                'company_id'          => $this->company->id,
                'company_name'        => $this->company->name,
                'company_website'     => $this->company->website,
                'company_email'       => $this->company->email,
                'company_phone'       => $this->company->phone,
                'company_license'     => $this->company->license,
                'company_address'     => $this->company->address,
                'company_description' => $this->company->description,
            ]),

            $this->mergeWhen($image = Image::find($this->image_id), [
                'image_id'  => $image->id,
                'image_url' => $image->url,
            ]),

            'role'          => $this->role->name,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'email'         => $this->email,
            'contact_phone' => $this->contact_phone,
            'username'      => $this->username,
        ];
    }
}
