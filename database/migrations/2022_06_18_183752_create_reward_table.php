<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reward', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('user_id');
            $table->string('pair_bv', 50);
            $table->string('reward');
            $table->string('rank', 50);
            $table->integer('level');
            $table->timestamp('c_date')->useCurrent();
            $table->tinyInteger('status');
            $table->integer('bonanza_id');
            $table->timestamp('pay_date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reward');
    }
}
