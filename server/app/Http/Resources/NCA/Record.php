<?php

namespace App\Http\Resources\NCA;

use Illuminate\Http\Resources\Json\JsonResource;

class Record extends JsonResource
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
            'type' => $this->type,
            'inventory_number' => $this->inventory_number,

            'address' => [
                'country' => $this->country,
                'province' => $this->province,
                'area' => $this->area,
                'locality' => $this->locality,
                'district' => $this->district,
                'metro' => $this->metro,
                'street' => $this->street,
                'house' => $this->house,
                'entrance' => $this->entrance,
            ],

            'function' => $this->function,
            'size' => $this->size,
            'walls' => $this->walls,
            'entry_date' => $this->entry_date,

            'transaction' => [
                'date' => $this->transaction_date,
                'id' => $this->transaction_id,
            ],

            'price' => [
                'description' => $this->price_description,
                'usd' => $this->price_usd,
                'sq_m_usd' => $this->price_sq_m_usd,
            ],

            'contract_price' => [
                'amount' => $this->contract_price_amount,
                'currency' => $this->contract_price_currency,
            ],

            'pieces' => [
                'before_transaction' => $this->pieces_before_transaction,
                'after_transaction' => $this->pieces_after_transaction,
            ],

            'rooms' => $this->rooms,
            'floor' => $this->floor,

            'capital' => [
                'floors' => $this->capital_floors,
                'underground_floors' => $this->capital_underground_floors,
            ],

            'extra_objects' => $this->extra_objects,

            'land' => [
                'cadastral_number' => $this->land_cadastral_number,
                'size' => $this->land_size,
            ],

            'markers' => $this->markers,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
