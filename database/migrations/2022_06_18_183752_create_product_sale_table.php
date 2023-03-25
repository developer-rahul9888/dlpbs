<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sale', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('p_id');
            $table->string('pname', 200);
            $table->string('slip_no', 200);
            $table->string('slip_img', 200);
            $table->string('address', 200);
            $table->float('amount', 10, 0);
            $table->string('status', 20);
            $table->timestamp('rdate')->useCurrent();
            $table->string('user_id', 25);
            $table->string('repurchase', 3);
            $table->string('dis_date', 20);
            $table->dateTime('deliverd_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_sale');
    }
}
