<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepurchaseIncomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repurchase_income', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->float('amount', 10);
            $table->integer('matching');
            $table->integer('user_send_by');
            $table->string('type', 50);
            $table->integer('order_id');
            $table->integer('pay_level');
            $table->string('description');
            $table->integer('status');
            $table->timestamp('c_date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repurchase_income');
    }
}
