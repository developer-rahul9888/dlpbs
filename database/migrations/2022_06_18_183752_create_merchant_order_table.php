<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_order', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name', 500);
            $table->string('price', 50);
            $table->float('tax', 10, 0);
            $table->integer('mid');
            $table->integer('qty');
            $table->text('image');
            $table->text('desc');
            $table->float('i_total', 10, 0);
            $table->float('sub_total', 10, 0);
            $table->integer('order_id');
            $table->string('status', 20)->default('pending');
            $table->timestamp('date')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_order');
    }
}
