<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributionAmountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribution_amount', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->float('amount', 10);
            $table->integer('user_id_send_by');
            $table->integer('pay_level');
            $table->string('status', 20);
            $table->integer('order_id');
            $table->string('type');
            $table->integer('sale_type');
            $table->string('description');
            $table->timestamp('pay_date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distribution_amount');
    }
}
