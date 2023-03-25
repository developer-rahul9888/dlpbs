<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('mid');
            $table->string('title');
            $table->string('image');
            $table->text('description');
            $table->integer('actual_price');
            $table->integer('discount_price');
            $table->string('s_date', 20);
            $table->string('e_date', 20);
            $table->text('terms');
            $table->string('status', 15);
            $table->timestamp('r_date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deals');
    }
}
