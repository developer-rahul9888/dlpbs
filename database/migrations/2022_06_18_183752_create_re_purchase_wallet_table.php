<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRePurchaseWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('re_purchase_wallet', function (Blueprint $table) {
            $table->integer('id', true)->unique('id');
            $table->string('user_id')->default('')->unique('user_id');
            $table->double('amount');
            $table->integer('status');
            $table->date('c_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('re_purchase_wallet');
    }
}
