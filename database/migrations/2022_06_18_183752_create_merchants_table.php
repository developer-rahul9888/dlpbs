<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('d_name', 200);
            $table->string('email');
            $table->string('gst', 250);
            $table->string('pass_word', 50);
            $table->string('merchant_id', 100);
            $table->string('phone', 20);
            $table->string('store_name', 256);
            $table->string('m_comm', 100);
            $table->string('status', 10);
            $table->string('delivery_charge', 250);
            $table->integer('merchant_type')->default(0);
            $table->timestamp('rdate')->useCurrent();
            $table->integer('access');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchants');
    }
}
