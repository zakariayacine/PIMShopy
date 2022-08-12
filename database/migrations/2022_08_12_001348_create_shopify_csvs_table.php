<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopify_csvs', function (Blueprint $table) {
            $table->id();
            $table->string('Handle');
            $table->string('Title');
            $table->string('BodyHTML');
            $table->string('Vendor');
            $table->string('StandardizedProductType');
            $table->string('CustomProductType');
            $table->string('Tags');
            $table->string('Published');
            $table->string('Option1Name');
            $table->string('Option1Value');
            $table->string('Option2Name');
            $table->string('Option2Value');
            $table->string('Option3Name');
            $table->string('Option3Value');
            $table->string('VariantSKU');
            $table->string('VariantGrams');
            $table->string('VariantInventoryTracker');
            $table->string('VariantInventoryQty');
            $table->string('VariantInventoryPolicy');
            $table->string('VariantFulfillmentService');
            $table->string('VariantPrice');
            $table->string('VariantCompareAtPrice');
            $table->string('VariantRequiresShipping');
            $table->string('VariantTaxable');
            $table->string('VariantBarcode');
            $table->string('ImageSrc');
            $table->string('ImagePosition');
            $table->string('ImageAltText');
            $table->string('GiftCard');
            $table->string('SEOTitle');
            $table->string('SEODescription');
            $table->string('GoogleShoppingGoogleProductCategory');
            $table->string('GoogleShoppingGender');
            $table->string('GoogleShoppingAgeGroup');
            $table->string('GoogleShoppingMPN');
            $table->string('GoogleShoppingAdWordsGrouping');
            $table->string('GoogleShoppingAdWordsLabels');
            $table->string('GoogleShoppingCondition');
            $table->string('GoogleShoppingCustomProduct');
            $table->string('GoogleShoppingCustomLabel0');
            $table->string('GoogleShoppingCustomLabel1');
            $table->string('GoogleShoppingCustomLabel2');
            $table->string('GoogleShoppingCustomLabel3');
            $table->string('GoogleShoppingCustomLabel4');
            $table->string('VariantImage');
            $table->string('VariantWeightUnit');
            $table->string('VariantTaxCode');
            $table->string('Costperitem');
            $table->string('PriceInternational');
            $table->string('CompareAtPriceInternational');
            $table->string('Status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopify_csvs');
    }
};
