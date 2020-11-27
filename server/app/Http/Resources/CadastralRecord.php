<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadastralRecord extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'record';

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
            'typeId' => $this->type_id,
            'inventoryNumber' => $this->inventory_number,
            'countryId' => $this->country_id,
            'provinceId' => $this->province_id,
            'areaId' => $this->area_id,
            'localityId' => $this->locality_id,
            'districtId' => $this->district_id,
            'metroId' => $this->metro_id,
            'streetId' => $this->street_id,
            'houseId' => $this->house_id,
            'entranceId' => $this->entrance_id,
            'lat' => $this->lat,
            'long' => $this->long,
            'functionId' => $this->function_id,
            'functionDescription' => $this->function_description,
            'name' => $this->name,
            'size' => $this->size,
            'walls' => $this->walls,
            'entryDate' => $this->entry_date,
            'transactionDate' => $this->transaction_date,
            'transactionId' => $this->transaction_id,
            'objectsCount' => $this->objects_count,
            'priceByn' => $this->price_byn,
            'priceSqmByn' => $this->price_sqm_byn,
            'priceDescription' => $this->price_description,
            'priceUsd' => $this->price_usd,
            'priceSqmUsd' => $this->price_sqm_usd,
            'priceEur' => $this->price_eur,
            'priceSqmEur' => $this->price_sqm_eur,
            'contractPriceAmount' => $this->contract_price_amount,
            'contractPriceCurrency' => $this->contract_price_currency,
            'piecesBeforeTransaction' => $this->pieces_before_transaction,
            'piecesAfterTransaction' => $this->pieces_after_transaction,
            'rooms' => $this->rooms,
            'floor' => $this->floor,
            'capitalInventoryNumber' => $this->capital_inventory_number,
            'capitalSize' => $this->capital_size,
            'capitalFunction' => $this->capital_function,
            'capitalFunctionDescription' => $this->capital_function_description,
            'capitalName' => $this->capital_name,
            'capitalReadyPercentage' => $this->capital_ready_percentage,
            'capitalFloors' => $this->capital_floors,
            'capitalUndergroundFloors' => $this->capital_underground_floors,
            'extraObjects' => $this->extra_objects,
            'landCadastralNumber' => $this->land_cadastral_number,
            'landFunction' => $this->land_function,
            'landSize' => $this->land_size,
            'ateUniqueNumber' => $this->ate_unique_number,
            'markers' => $this->markers,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
        ];
    }
}
