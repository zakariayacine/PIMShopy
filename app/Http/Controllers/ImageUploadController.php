<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopifyCsv;

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

    public function upload(Request $request, $id){
        $csv = ShopifyCsv::find($id);
        dd($request, 'first', $csv,'second');
    }
}
