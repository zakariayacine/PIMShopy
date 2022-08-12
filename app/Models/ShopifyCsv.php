<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopifyCsv extends Model
{
    use HasFactory;
    protected $fillable = [
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
}
