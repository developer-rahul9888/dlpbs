<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_log', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('userid');
            $table->string('type', 200);
            $table->text('description');
            $table->float('amount', 10);
            $table->float('tds', 10);
            $table->float('admin', 10);
            $table->float('net_income', 10);
            $table->string('status', 20);
            $table->string('bank_tran', 60);
            $table->timestamp('rdate')->useCurrent();
            $table->date('udate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_log');
    }
}
