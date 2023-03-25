<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedeemBlissTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redeem_bliss', function (Blueprint $table) {
            $table->integer('rd_id', true);
            $table->string('bank_tran');
            $table->string('balance', 10);
            $table->string('redeem', 10);
            $table->integer('after_tds');
            $table->integer('user_id');
            $table->string('redeem_status', 10)->default('pending');
            $table->timestamp('rdate')->useCurrent();
            $table->string('status', 50)->default('Redeem');
            $table->string('voucher_email', 50);
            $table->string('my_bliss_req', 15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('redeem_bliss');
    }
}
