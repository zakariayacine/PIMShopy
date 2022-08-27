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
        Schema::create('cvs_importations', function (Blueprint $table) {
            $table->id();
            $table->string('Vendor');
            $table->string('VariantWeightUnit');
            $table->foreignId('user_id')->constrained();
            //you can add mor automatic import fileds
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
        Schema::dropIfExists('cvs_importations');
    }
};
