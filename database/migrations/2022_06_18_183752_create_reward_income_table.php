<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardIncomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reward_income', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('user_id', 222);
            $table->float('old_pair', 10);
            $table->float('cur_pair', 10);
            $table->float('amount', 10);
            $table->float('tds', 10);
            $table->float('admin', 10);
            $table->float('net_income', 10);
            $table->integer('user_send_by');
            $table->integer('sale_type');
            $table->integer('order_id');
            $table->timestamp('c_date')->useCurrent();
            $table->float('pay_date', 10);
            $table->integer('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reward_income');
    }
}
