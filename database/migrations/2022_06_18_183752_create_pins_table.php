<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pins', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('pinid')->default('');
            $table->float('p_amount', 10, 0);
            $table->integer('b_volume');
            $table->integer('capping');
            $table->string('pin_type');
            $table->string('status')->default('Deactive');
            $table->timestamp('rdate')->useCurrent();
            $table->integer('package');
            $table->integer('percentage');
            $table->integer('re_purchase');
            $table->integer('franchisee');
            $table->integer('area_franc');
            $table->integer('dist_franc');
            $table->integer('state_franc');
            $table->string('created_by_user', 200);
            $table->string('assign_to');
            $table->string('sender_id');
            $table->string('move_to');
            $table->date('used_on');
            $table->string('used_by', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pins');
    }
}
