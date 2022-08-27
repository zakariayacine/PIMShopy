<?php
namespace App\Exports;

use App\Models\ShopifyCsv;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CsvsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = ShopifyCsv::select(
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
            'Status')->orderBy('Handle')->get();
        return  $data;
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [ "Handle","Title","Body (HTML)","Vendor","Standardized Product Type","Custom Product Type","Tags","Published","Option1 Name","Option1 Value","Option2 Name","Option2 Value","Option3 Name","Option3 Value","Variant SKU","Variant Grams","Variant Inventory Tracker","Variant Inventory Qty","Variant Inventory Policy","Variant Fulfillment Service","Variant Price","Variant Compare At Price","Variant Requires Shipping","Variant Taxable","Variant Barcode","Image Src","Image Position","Image Alt Text","Gift Card","SEO Title","SEO Description","Google Shopping / Google Product Category","Google Shopping / Gender","Google Shopping / Age Group","Google Shopping / MPN","Google Shopping / AdWords Grouping","Google Shopping / AdWords Labels","Google Shopping / Condition","Google Shopping / Custom Product","Google Shopping / Custom Label 0","Google Shopping / Custom Label 1","Google Shopping / Custom Label 2","Google Shopping / Custom Label 3","Google Shopping / Custom Label 4","Variant Image","Variant Weight Unit","Variant Tax Code","Cost per item","Price / International","Compare At Price / International","Status"];
    }
}
