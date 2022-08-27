<?php

namespace App\Imports;

use App\Models\ShopifyCsv;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
class CsvsImports implements ToModel
{
     /*
       * Titre du produit || from excel
       * le prix du produit dois etre sans symbole de devise et float || excel
       * quantité du produit en stock || excel
       * le poid du produit || from excel
       * la description du produit || from excel
       * 
       * le nom vendeur || configuration or excel 
       * le chemain complet du produit || from configuration or excel
       * l'unité de mesur du poid du produit || from configuration or excel
       *  titre	prix	qtt	poidunit	description	vendor	categorie
       * 
    */

    public function model(array $row)
    {
        $handle = Str::of($row[0])->slug('-');
        $id = auth()->id();
        $url = url('converted/'.$row[8] ?? '');
        if(!ShopifyCsv::where('handle', $handle)->get()){
            return new ShopifyCsv([
                'Handle' => $handle,
                'Title' => $row[0],
                'BodyHTML' =>  $row[5] ?? '<p>Ici la description de votre produit</p>',
                'Vendor' => $row[6] ?? '', //Ajouter le vendeur
                'StandardizedProductType' => $row[7] ?? '', //ajouter le chemain complet du produit
                'CustomProductType' => '',
                'Tags' => '',
                'Published' => 'TRUE',
                'Option1Name' => 'Title',
                'Option1Value' => 'Default Title',
                'Option2Name' => '',
                'Option2Value' => '',
                'Option3Name' => '',
                'Option3Value' => '',
                'VariantSKU' => '',
                'VariantGrams' => $row[3] ?? '', //poid
                'VariantInventoryTracker' => '', 
                'VariantInventoryQty' => $row[2], //quantité en stock
                'VariantInventoryPolicy' => 'deny', 
                'VariantFulfillmentService' => 'manuel',
                'VariantPrice' => $row[1] ?? '',
                'VariantCompareAtPrice' => '',
                'VariantRequiresShipping' => 'TRUE',
                'VariantTaxable' => 'TRUE',
                'VariantBarcode' => '',
                'ImageSrc' => $url,
                'ImagePosition' => '',
                'ImageAltText' => '',
                'GiftCard' => 'FALSE',
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
                'VariantWeightUnit' => $row[4] ?? '',
                'VariantTaxCode' => '',
                'Costperitem' => '',
                'PriceInternational' => '',
                'CompareAtPriceInternational' => '',
                'Status' => 'active',
                'user_id' => $id,
                'slave' => 'false',
            ]);
        }else{
            return new ShopifyCsv([
                'Handle' => $handle,
                'Title' => $row[0],
                'BodyHTML' =>  $row[5] ?? '<p>Ici la description de votre produit</p>',
                'Vendor' => $row[6] ?? '', //Ajouter le vendeur
                'StandardizedProductType' => $row[7] ?? '', //ajouter le chemain complet du produit
                'CustomProductType' => '',
                'Tags' => '',
                'Published' => 'TRUE',
                'Option1Name' => 'Title',
                'Option1Value' => 'Default Title',
                'Option2Name' => '',
                'Option2Value' => '',
                'Option3Name' => '',
                'Option3Value' => '',
                'VariantSKU' => '',
                'VariantGrams' => $row[3] ?? '', //poid
                'VariantInventoryTracker' => '', 
                'VariantInventoryQty' => $row[2], //quantité en stock
                'VariantInventoryPolicy' => 'deny', 
                'VariantFulfillmentService' => 'manuel',
                'VariantPrice' => $row[1] ?? '',
                'VariantCompareAtPrice' => '',
                'VariantRequiresShipping' => '',
                'VariantTaxable' => '',
                'VariantBarcode' => '',
                'ImageSrc' => $url,
                'ImagePosition' => $row[9],
                'ImageAltText' => '',
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
                'Status' => 'active',
                'user_id' => $id,
                'slave' => 'true',
            ]);
        }
        
    }
}