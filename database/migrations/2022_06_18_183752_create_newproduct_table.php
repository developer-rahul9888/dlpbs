<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewproductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newproduct', function (Blueprint $table) {
            $table->text('Handle');
            $table->text('Title');
            $table->text('Body');
            $table->text('Vendor');
            $table->text('Product_type');
            $table->text('SKU');
            $table->text('Weight');
            $table->text('Qty');
            $table->text('variant_price');
            $table->text('variant_compare_price');
            $table->text('image');
            $table->text('WeightUnit');
            $table->text('price');
            $table->text('Brand');
            $table->text('Status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('newproduct');
    }
}
