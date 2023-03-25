<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_product', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('p_id', 150)->nullable();
            $table->integer('web_id');
            $table->string('pname');
            $table->text('s_name');
            $table->string('category', 100);
            $table->text('description');
            $table->string('s_discription', 500);
            $table->string('image', 500);
            $table->string('visibility', 50);
            $table->string('sku', 50);
            $table->float('price', 10, 0)->comment('product actual price');
            $table->float('cost', 10, 0);
            $table->string('status', 15)->default('deactive');
            $table->string('product_type', 100);
            $table->text('attribute');
            $table->string('url', 1000);
            $table->timestamp('s_date')->useCurrentOnUpdate()->useCurrent();
            $table->string('e_date', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('web_product');
    }
}
