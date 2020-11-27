<?php

namespace App\Http\Controllers;

use App\Models\CadastralRecordType;
use Illuminate\Http\Request;
use App\Http\Resources\CadastralRecordTypes;
use App\Http\Resources\CadastralRecordType as CadastralRecordTypeResource;

class CadastralRecordTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CadastralRecordTypes(CadastralRecordType::all());
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
     * @param  \App\Models\CadastralRecordType  $cadastralRecordType
     * @return \Illuminate\Http\Response
     */
    public function show(CadastralRecordType $cadastralRecordType)
    {
        return new CadastralRecordTypeResource($cadastralRecordType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CadastralRecordType  $cadastralRecordType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CadastralRecordType $cadastralRecordType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CadastralRecordType  $cadastralRecordType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CadastralRecordType $cadastralRecordType)
    {
        //
    }
}
