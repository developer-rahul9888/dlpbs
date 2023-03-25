<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('p_id', 150)->nullable();
            $table->string('pname');
            $table->text('s_name');
            $table->string('category', 100);
            $table->integer('sub_category');
            $table->text('description');
            $table->text('s_discription');
            $table->string('image', 500);
            $table->string('on_hover', 50);
            $table->string('sku', 50);
            $table->string('weight', 15);
            $table->string('t_class', 200);
            $table->string('u_key', 200);
            $table->string('visibility', 100);
            $table->float('price', 10, 0)->comment('product actual price');
            $table->float('cost', 10, 0);
            $table->float('bv', 10, 0);
            $table->integer('delivery_charge');
            $table->string('hsn', 50);
            $table->string('dimensions');
            $table->string('origin', 50);
            $table->integer('actual_price');
            $table->float('p_d_price', 10, 0)->comment('product discount price');
            $table->integer('comm_dis')->comment('commission destribution price');
            $table->integer('reward');
            $table->integer('p_qty')->comment('product qty');
            $table->string('m_name', 100);
            $table->string('b_code', 50);
            $table->string('color', 50);
            $table->text('colors');
            $table->string('free_id', 250);
            $table->integer('mid');
            $table->string('model', 50);
            $table->integer('web_id');
            $table->string('s_p_n_f_date', 40);
            $table->string('rdate', 15);
            $table->string('status', 15)->default('deactive');
            $table->string('brand');
            $table->string('product_type', 100);
            $table->text('images');
            $table->text('attribute');
            $table->string('s_p_n_to_date', 40);
            $table->string('spfdate', 40);
            $table->string('sptdate', 40);
            $table->integer('free_product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
