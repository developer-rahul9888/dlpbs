<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_meta', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('merchant_id');
            $table->text('b_details');
            $table->string('brands', 200);
            $table->string('brand_proof', 300);
            $table->string('images', 500);
            $table->text('video');
            $table->string('business_type', 200);
            $table->string('address_s_1', 100);
            $table->string('address_s_2', 100);
            $table->string('city', 100);
            $table->string('state', 50);
            $table->integer('zip');
            $table->string('country', 50);
            $table->string('pickup_checkbox', 3);
            $table->string('p_address_s_1', 100);
            $table->string('p_address_s_2', 100);
            $table->string('p_city', 100);
            $table->string('p_state', 50);
            $table->integer('p_zip');
            $table->string('p_country', 50);
            $table->string('return_checkbox', 3);
            $table->string('r_address_s_1', 100);
            $table->string('r_address_s_2', 100);
            $table->string('sector');
            $table->string('r_city', 100);
            $table->string('r_state', 50);
            $table->integer('r_zip');
            $table->string('r_country', 50);
            $table->string('o_name', 200);
            $table->string('attribute', 256);
            $table->string('o_email', 200);
            $table->string('o_designation', 200);
            $table->string('o_phone', 15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_meta');
    }
}
