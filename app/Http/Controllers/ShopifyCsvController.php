<?php

namespace App\Http\Controllers;

use App\Models\ShopifyCsv;
use App\Imports\CsvsImports;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreShopifyCsvRequest;
use App\Http\Requests\UpdateShopifyCsvRequest;

class ShopifyCsvController extends Controller
{
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
    public function show(ShopifyCsv $shopifyCsv)
    {
        //
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
       $inputs = [
        'Handle',
        'Title',
        'BodyHTML',
        'Vendor',
        'StandardizedProductType',
        'CustomProductType',
        'Tags',
        'Published',
        'Option1Name',
        'Option1Value',
        'Option2Name',
        'Option2Value',
        'Option3Name',
        'Option3Value',
        'VariantSKU',
        'VariantGrams',
        'VariantInventoryTracker',
        'VariantInventoryQty',
        'VariantInventoryPolicy',
        'VariantFulfillmentService',
        'VariantPrice',
        'VariantCompareAtPrice',
        'VariantRequiresShipping',
        'VariantTaxable',
        'VariantBarcode',
        'ImageSrc',
        'ImagePosition',
        'ImageAltText',
        'GiftCard',
        'SEOTitle',
        'SEODescription',
        'GoogleShoppingGoogleProductCategory',
        'GoogleShoppingGender',
        'GoogleShoppingAgeGroup',
        'GoogleShoppingMPN',
        'GoogleShoppingAdWordsGrouping',
        'GoogleShoppingAdWordsLabels',
        'GoogleShoppingCondition',
        'GoogleShoppingCustomProduct',
        'GoogleShoppingCustomLabel0',
        'GoogleShoppingCustomLabel1',
        'GoogleShoppingCustomLabel2',
        'GoogleShoppingCustomLabel3',
        'GoogleShoppingCustomLabel4',
        'VariantImage',
        'VariantWeightUnit',
        'VariantTaxCode',
        'Costperitem',
        'PriceInternational',
        'CompareAtPriceInternational',
        'Status',
       ];
       return view('csvs.edit', compact('csv', 'inputs'));
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
}
