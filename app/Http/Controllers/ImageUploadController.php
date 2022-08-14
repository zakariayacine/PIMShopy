<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Exception;

class ImageUploadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload(Request $request, $id)
    {
        $url = $this->storeImageCloud($file = $request->file('image'));
        return $url;
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
        try {
            \Tinify\setKey(env("TINIFY_API_KEY"));
            $source = \Tinify\fromFile($file)
                ->resize(array(
                    "method" => "thumb",
                    "width" => 250,
                    "height" => 250
                ));
            $image = './converted/' . $file->getClientOriginalName();
            $source->toFile($image);
            $imageSource =  file_get_contents($image);

            //store image
            $path = "/productsImages/" . $file->getClientOriginalName();
            Storage::cloud()->put($path, $imageSource);

            //getting the URL

            $url = Storage::cloud()->url($path);

            return compact('url', 'path');
            
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
}
