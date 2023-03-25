<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnoverIncomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnover_income', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('income_type', 100);
            $table->string('type', 50);
            $table->string('user_id')->default('');
            $table->float('amount', 10)->default(0);
            $table->float('tds', 10);
            $table->float('admin', 10);
            $table->float('net_income', 10);
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
        Schema::dropIfExists('turnover_income');
    }
}
