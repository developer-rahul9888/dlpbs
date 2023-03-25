<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_voucher', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->integer('voucher_id');
            $table->string('image', 250);
            $table->string('pname', 250);
            $table->string('title', 250);
            $table->integer('price');
            $table->integer('quantity');
            $table->text('products');
            $table->string('status', 50)->default('Pending');
            $table->timestamp('date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_voucher');
    }
}
