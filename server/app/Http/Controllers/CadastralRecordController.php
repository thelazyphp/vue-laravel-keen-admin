<?php

namespace App\Http\Controllers;

use App\Models\CadastralRecord;
use Illuminate\Http\Request;
use App\Models\CadastralRecordType;
use App\Address\Resolver;
use App\Models\CadastralRecordFunction;
use Throwable;
use App\Http\Requests\QueryResourceCollection;
use App\Http\Resources\CadastralRecords;
use App\Http\Filters\CadastralRecordsFilter;
use App\Http\Resources\CadastralRecord as CadastralRecordResource;

class CadastralRecordController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $rules = [
            'records' => ['required', 'file', 'max:51200', 'mimes:xlsx'],
        ];

        $this->validate(
            $request,
            $rules,
            trans('api.errors.validation')
        );

        if (! $request->file('records')->isValid()) {
            return response()->json([
                'message' => trans('api.errors.upload'),
            ], 500);
        }

        $xlsx = \SimpleXLSX::parseData(
            $request->file('records')->get()
        );

        $rows = $xlsx->rows();

        $offset = 0;

        foreach ($rows as $key => $value) {
            if ($value[0] == 'п/п') {
                $offset = $key + 1;

                break;
            }

            continue;
        }

        $rows = array_splice($rows, $offset);

        foreach ($rows as $row) {
            $attrs = [];

            if (isset($row[1])) {
                $attrs['type_id'] = CadastralRecordType::firstOrCreate([
                    'name' => trim($row[1]),
                ])->id;
            }

            if (isset($row[2])) {
                $attrs['inventory_number'] = trim($row[2]);
            }

            if (isset($row[3])) {
                $addressResolver = new Resolver(true, ['Минск']);

                $addressComponents = $addressResolver->resolveAddressComponents(trim($row[3]));

                if (! is_null($addressComponents)) {
                    $attrs['country_id'] = optional($addressComponents->country)->id;
                    $attrs['province_id'] = optional($addressComponents->province)->id;
                    $attrs['area_id'] = optional($addressComponents->area)->id;
                    $attrs['locality_id'] = optional($addressComponents->locality)->id;
                    $attrs['district_id'] = optional($addressComponents->district)->id;
                    $attrs['metro_id'] = optional($addressComponents->metro)->id;
                    $attrs['street_id'] = optional($addressComponents->street)->id;
                    $attrs['house_id'] = optional($addressComponents->house)->id;
                    $attrs['entrance_id'] = optional($addressComponents->entrance)->id;
                    $attrs['lat'] = $addressComponents->lat;
                    $attrs['long'] = $addressComponents->long;
                }
            }

            if (isset($row[4])) {
                $functionAttrs = [
                    'name' => trim($row[4]),
                ];

                if (isset($attrs['type_id'])) {
                    $functionAttrs['type_id'] = $attrs['type_id'];
                }

                $attrs['function_id'] = CadastralRecordFunction::firstOrCreate($functionAttrs)->id;
            }

            if (isset($row[5])) {
                $attrs['function_description'] = trim($row[5]);
            }

            if (isset($row[6])) {
                $attrs['name'] = trim($row[6]);
            }

            if (isset($row[7])) {
                $attrs['size'] = ((float) $row[7]) ?: null;
            }

            if (isset($row[8])) {
                $attrs['walls'] = trim($row[8]);
            }

            if (isset($row[9])) {
                $attrs['entry_date'] = date(
                    'Y-m-d H:i:s', strtotime($row[9])
                );
            }

            if (isset($row[10])) {
                $attrs['transaction_date'] = date(
                    'Y-m-d H:i:s', strtotime($row[10])
                );
            }

            if (isset($row[11])) {
                $attrs['transaction_id'] = trim($row[11]);
            }

            if (isset($row[12])) {
                $attrs['objects_count'] = ((int) $row[12]) ?: null;
            }

            if (isset($row[13])) {
                $attrs['price_byn'] = ((float) $row[13]) ?: null;
            }

            if (isset($row[14])) {
                $attrs['price_sqm_byn'] = ((float) $row[14]) ?: null;
            }

            if (isset($row[15])) {
                $attrs['price_description'] = trim($row[15]);
            }

            if (isset($row[16])) {
                $attrs['price_usd'] = ((float) $row[16]) ?: null;
            }

            if (isset($row[17])) {
                $attrs['price_sqm_usd'] = ((float) $row[17]) ?: null;
            }

            if (isset($row[18])) {
                $attrs['price_eur'] = ((float) $row[18]) ?: null;
            }

            if (isset($row[19])) {
                $attrs['price_sqm_eur'] = ((float) $row[19]) ?: null;
            }

            if (isset($row[20])) {
                $attrs['contract_price_amount'] = ((float) $row[20]) ?: null;
            }

            if (isset($row[21])) {
                $attrs['contract_price_currency'] = trim($row[21]);
            }

            if (isset($row[22])) {
                $attrs['pieces_before_transaction'] = trim($row[22]);
            }

            if (isset($row[23])) {
                $attrs['pieces_after_transaction'] = trim($row[23]);
            }

            if (isset($row[24])) {
                $attrs['rooms'] = ((int) $row[24]) ?: null;
            }

            if (isset($row[25])) {
                $attrs['floor'] = ((int) $row[25]) ?: null;
            }

            if (isset($row[26])) {
                $attrs['capital_inventory_number'] = trim($row[26]);
            }

            if (isset($row[27])) {
                $attrs['capital_size'] = ((float) $row[27]) ?: null;
            }

            if (isset($row[28])) {
                $attrs['capital_function'] = trim($row[28]);
            }

            if (isset($row[29])) {
                $attrs['capital_function_description'] = trim($row[29]);
            }

            if (isset($row[30])) {
                $attrs['capital_name'] = trim($row[30]);
            }

            if (isset($row[31])) {
                $attrs['capital_ready_percentage'] = ((int) $row[31]) ?: null;
            }

            if (isset($row[32])) {
                $attrs['capital_floors'] = ((int) $row[32]) ?: null;
            }

            if (isset($row[33])) {
                $attrs['capital_underground_floors'] = ((int) $row[33]) ?: null;
            }

            if (isset($row[34])) {
                $attrs['extra_objects'] = trim($row[34]);
            }

            if (isset($row[35])) {
                $attrs['land_cadastral_number'] = trim($row[35]);
            }

            if (isset($row[36])) {
                $attrs['land_function'] = trim($row[36]);
            }

            if (isset($row[37])) {
                $attrs['land_size'] = ((float) $row[37]) ?: null;
            }

            if (isset($row[38])) {
                $attrs['ate_unique_number'] = trim($row[38]);
            }

            if (isset($row[39])) {
                $attrs['markers'] = trim($row[39]);
            }

            if (! empty($attrs)) {
                try {
                    CadastralRecord::updateOrCreate([
                        'inventory_number' => $attrs['inventory_number'],
                        'transaction_id' => $attrs['transaction_id'],
                    ], $attrs);
                } catch (Throwable $e) {
                    //

                    continue;
                }
            }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\QueryResourceCollection  $request
     * @return \Illuminate\Http\Response
     */
    public function index(QueryResourceCollection $request)
    {
        return new CadastralRecords(
            CadastralRecord::queryFilter(new CadastralRecordsFilter($request))->paginate($request->query('limit')),
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CadastralRecord  $cadastralRecord
     * @return \Illuminate\Http\Response
     */
    public function show(CadastralRecord $cadastralRecord)
    {
        return new CadastralRecordResource($cadastralRecord);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CadastralRecord  $cadastralRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CadastralRecord $cadastralRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CadastralRecord  $cadastralRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(CadastralRecord $cadastralRecord)
    {
        //
    }
}
