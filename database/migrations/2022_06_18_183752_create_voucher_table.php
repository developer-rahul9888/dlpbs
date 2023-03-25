<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('p_id', 150)->nullable();
            $table->string('pname');
            $table->text('s_name');
            $table->string('attribute');
            $table->string('category', 100);
            $table->text('description');
            $table->string('s_discription', 500);
            $table->string('image', 500);
            $table->string('sku', 50);
            $table->string('weight', 15);
            $table->float('price', 10, 0)->comment('product actual price');
            $table->integer('points');
            $table->integer('p_qty')->comment('product qty');
            $table->timestamp('rdate')->useCurrentOnUpdate()->useCurrent();
            $table->string('status', 15)->default('deactive');
            $table->integer('comm_dis')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voucher');
    }
}
