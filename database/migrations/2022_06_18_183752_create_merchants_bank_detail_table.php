<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsBankDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants_bank_detail', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('merchant_id', 20);
            $table->string('ac_h_name', 50);
            $table->string('ac_no', 30);
            $table->string('gst', 256);
            $table->string('b_name', 50);
            $table->string('city', 20);
            $table->string('br_detail', 100);
            $table->string('ifce_code', 20);
            $table->string('mirc_code', 30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchants_bank_detail');
    }
}
