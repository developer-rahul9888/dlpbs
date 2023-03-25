<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_detail', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->integer('stock_send_qty');
            $table->integer('p_id');
            $table->integer('qty');
            $table->string('status', 50);
            $table->timestamp('date')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_detail');
    }
}
