<?php

namespace App\Imports;

use App\Models\ShopifyCsv;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class CsvsImports implements ToModel
{
    public function model(array $row)
    {
        return new ShopifyCsv([
            'Handle' => $row[2],
            'Title' => $row[2],
            'BodyHTML' => 'somthing',
            'Vendor' => 'somthing',
            'StandardizedProductType' => 'somthing',
            'CustomProductType' => 'somthing',
            'Tags' => 'somthing',
            'Published' => 'somthing',
            'Option1Name' => 'somthing',
            'Option1Value' => 'somthing',
            'Option2Name' => 'somthing',
            'Option2Value' => 'somthing',
            'Option3Name' => 'somthing',
            'Option3Value' => 'somthing',
            'VariantSKU' => 'somthing',
            'VariantGrams' => 'somthing',
            'VariantInventoryTracker' => 'somthing',
            'VariantInventoryQty' => 'somthing',
            'VariantInventoryPolicy' => 'somthing',
            'VariantFulfillmentService' => 'somthing',
            'VariantPrice' => 'somthing',
            'VariantCompareAtPrice' => 'somthing',
            'VariantRequiresShipping' => 'somthing',
            'VariantTaxable' => 'somthing',
            'VariantBarcode' => 'somthing',
            'ImageSrc' => 'somthing',
            'ImagePosition' => 'somthing',
            'ImageAltText' => 'somthing',
            'GiftCard' => 'somthing',
            'SEOTitle' => 'somthing',
            'SEODescription' => 'somthing',
            'GoogleShoppingGoogleProductCategory' => 'somthing',
            'GoogleShoppingGender' => 'somthing',
            'GoogleShoppingAgeGroup' => 'somthing',
            'GoogleShoppingMPN' => 'somthing',
            'GoogleShoppingAdWordsGrouping' => 'somthing',
            'GoogleShoppingAdWordsLabels' => 'somthing',
            'GoogleShoppingCondition' => 'somthing',
            'GoogleShoppingCustomProduct' => 'somthing',
            'GoogleShoppingCustomLabel0' => 'somthing',
            'GoogleShoppingCustomLabel1' => 'somthing',
            'GoogleShoppingCustomLabel2' => 'somthing',
            'GoogleShoppingCustomLabel3' => 'somthing',
            'GoogleShoppingCustomLabel4' => 'somthing',
            'VariantImage' => 'somthing',
            'VariantWeightUnit' => 'somthing',
            'VariantTaxCode' => 'somthing',
            'Costperitem' => 'somthing',
            'PriceInternational' => 'somthing',
            'CompareAtPriceInternational' => 'somthing',
            'Status' => 'somthing',
        ]);
    }
}
