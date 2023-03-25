<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->float('amount', 10);
            $table->integer('user_send_by');
            $table->string('type', 50);
            $table->integer('pay_level');
            $table->string('description');
            $table->string('status', 10);
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
        Schema::dropIfExists('incomes');
    }
}
