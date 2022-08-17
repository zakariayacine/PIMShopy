<?php

namespace App\Http\Controllers;

use App\Models\Image as modalImage;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use Exception;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = modalImage::where('user_id', Auth()->id())->get();
        return view('images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImageRequest $request)
    {

        if($request->file('images')){
            foreach ($request->file('images') as $image) {
                $url = $this->storeImageCloud($image);
                $image = new modalImage();
                $image->user_id = Auth()->id();
                $image->localUrl = strval(Arr::get($url, 'localPath'));
                $image->cloudUrl = strval(Arr::get($url, 'url'));
                $image->save();
            } 
            return redirect('/images');
        }
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(modalImage $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(modalImage $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateImageRequest  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImageRequest $request, modalImage $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        modalImage::find($request->id)->firstorfail()->delete();
        return redirect('/images');
    }

    /**
     * This function allow to compress file using TinyPng service
     * And upload the result file into a DropBox bucket
     * This function will return the path of the stored file in local
     * And the path of the cloud path
     * 
     * TinyPng compression Part :
     *
     * @return https://tinypng.com/developers/reference/php
     * 
     * You need to add the token key in your env file TINIFY_API_KEY
     * Read the documentation to understand the implemantation
     *
     * @return https://www.yellowduck.be/posts/using-dropbox-as-a-laravel-filesystem
     * 
     * Putting dropbox default cloud storage to get accesss to method url
     * See the config/filesystems 'cloud' => env('FILESYSTEM_CLOUD', 'dropbox'),
     * You need to add the token key in your env file DROPBOX_ACCESS_TOKEN  FILESYSTEM_CLOUD="dropbox"
     * Now we can call storage::cloud() insted of storage::disk('dropbox')
     * 
     */

    public function storeImageCloud($file)
    {

        $originalName = $file->getClientOriginalName();
        $path = "/converted/" .$originalName;
        $localPath = '/converted/'.$originalName;  
        $watermark = public_path("/watermark/water.jpg");
        $interImage = Image::make($watermark);
        $interImage->insert($file, 'center');
        $interImage->save('./toBeConverted/'.$originalName);

        $key = config('app.tiny_png');
        try {
            \Tinify\setKey($key);
            $source = \Tinify\fromFile('./toBeConverted/'.$originalName)
                ->resize(array(
                    "method" => "thumb",
                    "width" => 250,
                    "height" => 250
                ));
            
            $source->toFile('./converted/'.$originalName);  
            /** 
             * Need to solve S3 connexion with minio
             *  $imageSource =  file_get_contents($image);
             * 
             * store image
             * 
             * $localPath = '/converted/'. $originalName;
             *  try {
             *    Storage::disk('s3')->put($path, $imageSource);
             * } catch (\Throwable $th) {
             *     dd($th);
             * }
             *     
             * getting the URL
             * $url = Storage::cloud()->url($path);
             */
             $url = $localPath;
            return compact('url', 'localPath');
            
        } catch (\Tinify\AccountException $e) {
            // Verify your API key and account limit.
            return $e->getMessage();
        } catch (\Tinify\ClientException $e) {
            // Check your source image and request options.
            return $e->getMessage();
        } catch (\Tinify\ServerException $e) {
            // Temporary issue with the Tinify API.
            return $e->getMessage();
        } catch (\Tinify\ConnectionException $e) {
            // A network connection error occurred.
            return $e->getMessage();
        } catch (Exception $e) {
            // Something else went wrong, unrelated to the Tinify API.
            return $e->getMessage();
        }
    }


    public function updateImage(Request $request){
        $images  =  modalImage::query()
            ->where('localUrl', 'LIKE', "%{$request->imageName}%")
            ->get();
            
        return response()->json([
            "images" => $images,
            "message" => "200",
        ]);
    }
}
