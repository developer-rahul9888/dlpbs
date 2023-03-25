<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadReceiptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_receipt', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('website', 25);
            $table->string('product', 25);
            $table->string('image', 50);
            $table->string('description');
            $table->string('amount', 115);
            $table->string('status', 115);
            $table->string('customer_id', 115);
            $table->integer('commission');
            $table->integer('cashback');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upload_receipt');
    }
}
