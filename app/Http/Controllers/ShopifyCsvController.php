<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\CsvsExport;
use App\Models\ShopifyCsv;
use App\Imports\CsvsImports;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreShopifyCsvRequest;
use App\Http\Requests\UpdateShopifyCsvRequest;
use Illuminate\Support\Arr;
use App\Rules\ImageExistRule;
use Exception;
use Image;
use App\Models\Image as modalImage;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class ShopifyCsvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $csv = ShopifyCsv::where('slave', 'false')->paginate(4);
        return view('csvs.index', compact('csv'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        return view('csvs.import');
    }

    public function upload(StoreShopifyCsvRequest $request)
    {
        Excel::import(new CsvsImports, $request->file('excel'));
        return redirect('/')->with('success', 'All good!');
        // dd($request);
        // return view('home');
    }

    public function export()
    {
        return Excel::download(new CsvsExport, 'invoices.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreShopifyCsvRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShopifyCsvRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShopifyCsv  $shopifyCsv
     * @return \Illuminate\Http\Response
     */
    public function show(ShopifyCsv $shopifyCsv, $id)
    {
       $csv = $shopifyCsv::find($id);
       $images = ShopifyCsv::where('Handle', $csv->Handle)->where('slave', 'true')->get();
       return view('csvs.show', compact('csv','images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShopifyCsv  $shopifyCsv
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $csv = ShopifyCsv::find($id);
        $images = ShopifyCsv::where('Handle', $csv->Handle)->where('slave', 'true')->get();
        $pictures = [
            'ImageSrc',
            'ImagePosition',
            'ImageAltText',
        ];
        $defaultinputs = [
            'Handle' => ['input','text'],
            'Title'=> ['input','text'],
            'BodyHTML'=> ['textarea','10'],
            'Vendor'=> ['input','text'],
            'StandardizedProductType'=> ['input','text'],
            'CustomProductType'=> ['input','text'],
            'Tags'=> ['input','text'],
            'Published' => ['select' => ['TRUE', 'FALSE']],
            'Option1Name'=> ['input','text'],
            'Option1Value'=> ['input','text'],
            'VariantGrams'=> ['input','number'],
            'VariantInventoryQty'=> ['input','number'],
            'VariantInventoryPolicy'=> ['input','text'],
            'VariantFulfillmentService'=> ['input','text'],
            'VariantPrice'=> ['input','number'],
            'VariantRequiresShipping'=> ['select' => ['TRUE','FALSE']],
            'VariantTaxable'=> ['select' => ['TRUE','FALSE']],
            'VariantWeightUnit'=> ['select' => ['KG','G','LB','OZ']],
            'PriceInternational'=> ['input','number'],
            'CompareAtPriceInternational'=> ['input','number'],
            'Status'=> ['select' => ['active','draft','archived']],
        ];
        $OptionInputs = [
            'Option2Name' => ['input', 'text'],
            'Option2Value' => ['input', 'text'],
            'Option3Name' => ['input', 'text'],
            'Option3Value' => ['input', 'text'],
            'VariantSKU' => ['input', 'text'],
            'VariantInventoryTracker' => ['input', 'text'],
            'VariantCompareAtPrice' => ['input', 'number'],
            'VariantBarcode' => ['input', 'number'],
            'VariantImage' => ['input', 'text'],
            'VariantTaxCode' => ['input', 'text'],
            'Costperitem' => ['input', 'text'],
            'GiftCard' => ['input', 'text'],
        ];
        $SEOInputs = [
            'SEOTitle' => ['input', 'text'],
            'SEODescription' => ['textarea', '10'],
            'GoogleShoppingGoogleProductCategory' => ['input', 'text'],
            'GoogleShoppingGender' => ['input', 'text'],
            'GoogleShoppingAgeGroup' => ['input', 'text'],
            'GoogleShoppingMPN' => ['input', 'text'],
            'GoogleShoppingAdWordsGrouping' => ['input', 'text'],
            'GoogleShoppingAdWordsLabels' => ['input', 'text'],
            'GoogleShoppingCondition' => ['input', 'text'],
            'GoogleShoppingCustomProduct' => ['input', 'text'],
            'GoogleShoppingCustomLabel0' => ['input', 'text'],
            'GoogleShoppingCustomLabel1' => ['input', 'text'],
            'GoogleShoppingCustomLabel2' => ['input', 'text'],
            'GoogleShoppingCustomLabel3' => ['input', 'text'],
            'GoogleShoppingCustomLabel4' => ['input', 'text'],
        ];
        $default =[];
        foreach ($defaultinputs as $key => $value) {
            array_push($default, $this->traitemente($key , $value, $csv));
        }
        $optional =[];
        foreach ($OptionInputs as $key => $value) {
            array_push($optional, $this->traitemente($key , $value, $csv));
        }
        $seo =[];
        foreach ($SEOInputs as $key => $value) {
            array_push($seo, $this->traitemente($key , $value, $csv));
        }

        return view('csvs.edit', compact('csv','seo','optional','default','pictures','images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShopifyCsvRequest  $request
     * @param  \App\Models\ShopifyCsv  $shopifyCsv
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShopifyCsvRequest $request, ShopifyCsv $shopifyCsv)
    {
        //
    }

    public function imageUpdate(Request $request)
    {
        //validation
        $validated = $request->validate([
            "position" => 'required|size:1',
            "description" => 'required|max:255',
            "cvsid" => 'required',
            "imgUrl" => ['required', 'string', new ImageExistRule],
        ]);
        //verification if cvs id is id of auth user
        $cvs = ShopifyCsv::where("id", $request->cvsid)->firstOrFail();
        if ($cvs->user_id === auth()->id()) {
            if (!file_exists(public_path($request->imgUrl))) {
                //if from server
                try {
                   $file = file_get_contents($request->imgUrl);
                   $url =  $this->storeImage($file, $cvs->Title);
                   $this->saveImage($request->position , $cvs , $url,$request->description);
                   return redirect("/edit/".$cvs->id);
                } catch (\Throwable $th) {
                   dd($th);
                }
            }
            //verification completed do the logic 
        //created method updating image with switch of option fro the position image

            $this->saveImage($request->position , $cvs , url($request->imgUrl),$request->description);
             // redirect back
            return redirect("/edit/".$cvs->id);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShopifyCsv  $shopifyCsv
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopifyCsv $shopifyCsv)
    {
        //
    }

    public function traitemente($originalInputName , $variableInputs, $csv)
    {
        foreach ($variableInputs as $key => $inputName) {
          
           if(!is_string($inputName)){
            if ($key === "select") {
                $option = [];
                foreach ($inputName as $seckey => $value) {
                        array_push($option,'<option value="'.$value.'">'.$value.'</option>');
                }
                $select = '<label class="col-form-label text-md-end"><b>'.ucwords(implode('',preg_split('/(?=[A-Z])/',$originalInputName))).'</b></label><select class="form-control" name="'.$originalInputName.'">'.Arr::join($option, ' ').'</select>';
                
                return $select;
            } 
           }elseif($inputName === "textarea") {
                return '<label class="col-form-label text-md-end"><b>'.ucwords(implode('',preg_split('/(?=[A-Z])/',$originalInputName))).'</b></label><textarea class="form-control" name="'.$originalInputName.'" id="" cols="10" rows="2">'.$csv->$originalInputName.'</textarea>';
            } 
            if ($inputName === "input"){
                return '<label class="col-form-label text-md-end"><b>'.ucwords(implode('',preg_split('/(?=[A-Z])/',$originalInputName))).'</b></label><input class="form-control" value="'.$csv->$originalInputName.'" class="form-control" type="text" name="'.$originalInputName.'">'; 
            }
        }
    }

    public function storeImage($file, $name)
    {
        try {
            $originalName = $file->getClientOriginalName();
        } catch (\Throwable $th) {
            $originalName = Str::of($name)->slug('-').'.jpg';
        }
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
                    "width" => 400,
                    "height" => 400
                ));
            
            $source->toFile('./converted/'.$originalName);  
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

    public function saveImage($value, $cvs , $url,$ImageAltText)
    {
        if(is_array($url))
        {
           $urlData =  $url['url'];
        }else{
            $urlData = $url; 
        }
        switch ($value) {
            case '1':
                $cvs->ImageSrc = url($urlData);
                $cvs->ImagePosition = 1;
                $cvs->update();
                return $cvs;
                break;
            case '2':
                $data = ShopifyCsv::where('Handle', $cvs->Handle)->where('ImagePosition','2')->first();
                if($data){
                    $data->ImageSrc = url($urlData);
                    $data->ImagePosition = 2;
                    $data->ImageAltText = $ImageAltText;
                    $data->update();
                    return $data;
                }else{
                 return $this->newCsv($cvs->Handle,$urlData,'2',$ImageAltText);
                }
                break;
            case '3':
                $data = ShopifyCsv::where('Handle', $cvs->Handle)->where('ImagePosition','3')->first();
                if($data){
                    $data->ImageSrc = url($urlData);
                    $data->ImagePosition = 3;
                    $data->ImageAltText = $ImageAltText;
                    $data->update();
                    return $data;
                }else{
                 return $this->newCsv($cvs->Handle,$urlData,'3',$ImageAltText);
                }
                break;
            case '4':
                $data = ShopifyCsv::where('Handle', $cvs->Handle)->where('ImagePosition','4')->first();
                if($data){
                    $data->ImageSrc = url($urlData);
                    $data->ImagePosition = 4;
                    $data->ImageAltText = $ImageAltText;
                    $data->update();
                    return $data;
                }else{
                 return $this->newCsv($cvs->Handle,$urlData,'4',$ImageAltText);
                }
                break;
            default:
                abort('404');
                break;
        }
    }

    public function newCsv($handle,$url,$position,$ImageAltText){
        $id = auth()->id();
        $data = new ShopifyCsv([
            'Handle' => $handle,
            'Title' => '',
            'BodyHTML' => '',
            'Vendor' => '',
            'StandardizedProductType' => '',
            'CustomProductType' => '',
            'Tags' => '',
            'Published' => '',
            'Option1Name' => '',
            'Option1Value' => '',
            'Option2Name' => '',
            'Option2Value' => '',
            'Option3Name' => '',
            'Option3Value' => '',
            'VariantSKU' => '',
            'VariantGrams' => '',
            'VariantInventoryTracker' => '', 
            'VariantInventoryQty' => '',
            'VariantInventoryPolicy' => '', 
            'VariantFulfillmentService' => '',
            'VariantPrice' => '',
            'VariantCompareAtPrice' => '',
            'VariantRequiresShipping' => '',
            'VariantTaxable' => '',
            'VariantBarcode' => '',
            'ImageSrc' => $url,
            'ImagePosition' => $position,
            'ImageAltText' => $ImageAltText,
            'GiftCard' => '',
            'SEOTitle' => '',
            'SEODescription' => '',
            'GoogleShoppingGoogleProductCategory' => '',
            'GoogleShoppingGender' => '',
            'GoogleShoppingAgeGroup' => '',
            'GoogleShoppingMPN' => '',
            'GoogleShoppingAdWordsGrouping' => '',
            'GoogleShoppingAdWordsLabels' => '',
            'GoogleShoppingCondition' => '',
            'GoogleShoppingCustomProduct' => '',
            'GoogleShoppingCustomLabel0' => '',
            'GoogleShoppingCustomLabel1' => '',
            'GoogleShoppingCustomLabel2' => '',
            'GoogleShoppingCustomLabel3' => '',
            'GoogleShoppingCustomLabel4' => '',
            'VariantImage' => '',
            'VariantWeightUnit' => '',
            'VariantTaxCode' => '',
            'Costperitem' => '',
            'PriceInternational' => '',
            'CompareAtPriceInternational' => '',
            'Status' => '',
            'user_id' => $id,
            'slave' => 'true',
        ]);
        $data->save();
    }
}
