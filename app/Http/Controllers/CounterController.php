<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Http\Requests\StoreCounterRequest;
use App\Http\Requests\UpdateCounterRequest;
use App\Jobs\TinypngJob;
use App\Models\Tinypng;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Image;
class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('https://world.openfoodfacts.org/api/v0/product/737628064502.json');
        dd($response);
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $file = $request->file('image');
        $FristTraitement = Image::make($file);
        $FristTraitement->resize(400, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $originalName = $file->getClientOriginalName(); 
        $watermark = public_path("/watermark/water.jpg");
        $interImage = Image::make($watermark);
        $interImage->insert($FristTraitement, 'center');
        $interImage->save('./toBeTreated/'.$originalName);
        $path = 'toBeTreated/'.$originalName;
        $key = config('app.tiny_png');
        TinypngJob::dispatch($path,$originalName,$key,$request->auth);
        return response()->json([  
            "user_id" => $request->auth,    
            "id" => $request->id,
            "status" => 200,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCounterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCounterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function show(Counter $counter)
    {
        return view('images.test');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function edit(Counter $counter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCounterRequest  $request
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCounterRequest $request, Counter $counter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Counter $counter)
    {
        //
    }
}
