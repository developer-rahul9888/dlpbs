<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepurchaseWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repurchase_wallet', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('user_id')->default('');
            $table->float('credit_amt', 10)->default(0);
            $table->float('debit_amt', 10)->default(0);
            $table->float('final_bal', 10)->default(0);
            $table->string('receiver_id');
            $table->string('sender_id', 11)->default('');
            $table->date('receive_date')->default('0000-00-00');
            $table->string('ttype')->default('');
            $table->string('TranDescription')->default('');
            $table->string('Cause')->default('');
            $table->string('Remark')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repurchase_wallet');
    }
}
