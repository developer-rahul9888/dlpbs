<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionSummeryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_summery', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('user_id', 15);
            $table->string('dis', 15);
            $table->float('dr', 10, 0);
            $table->float('cr', 10, 0);
            $table->integer('qty');
            $table->integer('comment');
            $table->string('how_to_pay', 15);
            $table->string('coupon_val', 20);
            $table->string('coupon', 20);
            $table->string('status', 10);
            $table->timestamp('e_date')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_summery');
    }
}
