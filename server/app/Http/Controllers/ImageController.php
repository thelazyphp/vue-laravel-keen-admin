<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadImage;
use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except([
            //
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UploadImage  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadImage $request)
    {
        $validated = $request->validated();

        $path = $validated['file']
            ->store('images', 'public');

        return Image::create([
            'url' => env('APP_URL').'/storage/'.$path,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
