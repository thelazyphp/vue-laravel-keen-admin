<?php

namespace App\Http\Controllers\API\NCA;

use App\Http\Controllers\Controller;
use App\Models\NCA\Record;
use Illuminate\Http\Request;
use App\Http\Resources\NCA\Records;
use App\Http\Resources\NCA\Record as RecordResource;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new Records(
            Record::paginate(
                request('per_page')
            )
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
     * @param  \App\Models\NCA\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        return new RecordResource($record);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NCA\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NCA\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        //
    }
}
