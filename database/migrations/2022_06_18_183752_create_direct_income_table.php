<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectIncomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_income', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('user_id')->default('');
            $table->string('payby')->default('');
            $table->float('amount', 10)->default(0);
            $table->float('tds', 10);
            $table->float('admin', 10);
            $table->float('net_income', 10);
            $table->integer('user_send_by');
            $table->timestamp('c_date')->useCurrent();
            $table->date('pay_date');
            $table->boolean('status')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direct_income');
    }
}
