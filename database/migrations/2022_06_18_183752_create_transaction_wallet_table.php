<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_wallet', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('user_id', 50);
            $table->string('send_to', 50);
            $table->string('send_by', 50);
            $table->string('type', 200);
            $table->string('wallet_type')->default('Main Wallet');
            $table->text('description');
            $table->float('amount', 10, 0);
            $table->integer('credit');
            $table->integer('debit');
            $table->string('status', 20);
            $table->string('bank_tran', 60);
            $table->timestamp('rdate')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_wallet');
    }
}
