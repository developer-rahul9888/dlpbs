<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('pname');
            $table->string('s_name');
            $table->string('status');
            $table->string('description');
            $table->string('s_discription');
            $table->string('product_type');
            $table->string('image');
            $table->string('attribute');
            $table->string('category');
            $table->string('p_id');
            $table->string('url');
            $table->string('web_id');
            $table->string('sku');
            $table->timestamp('rdate', 6)->default('current_timestamp(6)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer');
    }
}
