<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->string('p_name', 100);
            $table->string('p_email', 100);
            $table->string('p_phone', 15);
            $table->string('p_address', 200);
            $table->string('p_address2', 100);
            $table->string('p_city', 100);
            $table->string('p_state', 60);
            $table->integer('p_zip');
            $table->text('items');
            $table->string('spl_note', 500);
            $table->string('coupon', 100)->nullable();
            $table->string('coupon_val', 20)->nullable();
            $table->string('how_to_pay', 50);
            $table->string('shipping', 70);
            $table->string('tax', 15);
            $table->string('total_amount', 20);
            $table->string('status', 30)->default('Pending');
            $table->string('comm_dis', 10);
            $table->timestamp('o_date')->useCurrent();
            $table->string('emi', 10)->default('no');
            $table->string('emi_info', 150)->default('no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
