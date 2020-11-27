<?php

namespace App\Http\Controllers;

use App\Models\CadastralRecordFunction;
use Illuminate\Http\Request;
use App\Http\Requests\QueryResourceCollection;
use App\Http\Resources\CadastralRecordFunctions;
use App\Http\Filters\CadastralRecordFunctionsFilter;
use App\Http\Resources\CadastralRecordFunction as CadastralRecordFunctionResource;

class CadastralRecordFunctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\QueryResourceCollection  $request
     * @return \Illuminate\Http\Response
     */
    public function index(QueryResourceCollection $request)
    {
        return new CadastralRecordFunctions(
            CadastralRecordFunction::queryFilter(new CadastralRecordFunctionsFilter($request))->get()
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
     * @param  \App\Models\CadastralRecordFunction  $cadastralRecordFunction
     * @return \Illuminate\Http\Response
     */
    public function show(CadastralRecordFunction $cadastralRecordFunction)
    {
        return new CadastralRecordFunctionResource($cadastralRecordFunction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CadastralRecordFunction  $cadastralRecordFunction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CadastralRecordFunction $cadastralRecordFunction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CadastralRecordFunction  $cadastralRecordFunction
     * @return \Illuminate\Http\Response
     */
    public function destroy(CadastralRecordFunction $cadastralRecordFunction)
    {
        //
    }
}
