<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_sale', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->float('gtotal', 10, 0);
            $table->timestamp('rdate')->useCurrentOnUpdate()->useCurrent();
            $table->integer('bv');
            $table->text('products');
            $table->float('before_tax_amount', 10, 0);
            $table->float('discount', 10, 0);
            $table->integer('wallet_credit');
            $table->string('customer');
            $table->string('payment_type', 100);
            $table->string('slip_no', 50);
            $table->float('total_gst', 10, 0);
            $table->timestamp('tdate')->useCurrent();
            $table->integer('center_id');
            $table->integer('pin_bill');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('total_sale');
    }
}
