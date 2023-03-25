<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_product', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('p_id', 150)->nullable();
            $table->string('pname');
            $table->text('s_name');
            $table->string('category', 100);
            $table->text('description');
            $table->string('s_discription', 500);
            $table->string('image', 500);
            $table->string('sku', 50);
            $table->string('weight', 15);
            $table->string('t_class', 200);
            $table->integer('mid');
            $table->string('visibility', 100);
            $table->float('price', 10, 0)->comment('product actual price');
            $table->float('cost', 10, 0);
            $table->float('actual_price', 10);
            $table->float('p_d_price', 10, 0)->comment('product discount price');
            $table->integer('p_qty')->comment('product qty');
            $table->string('hsn', 50);
            $table->string('dimensions');
            $table->string('origin', 50);
            $table->integer('free_product');
            $table->string('m_name', 100);
            $table->string('b_code', 50);
            $table->string('color', 50);
            $table->text('colors');
            $table->string('free_id', 250);
            $table->string('model', 50);
            $table->string('s_p_n_f_date', 40);
            $table->string('rdate', 15);
            $table->string('status', 15)->default('deactive');
            $table->string('product_type', 100);
            $table->text('images');
            $table->text('attribute');
            $table->string('s_p_n_to_date', 40);
            $table->string('spfdate', 40);
            $table->string('sptdate', 40);
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
        Schema::dropIfExists('admin_product');
    }
}
