<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamBussinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_bussiness', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->float('amount', 10);
            $table->integer('user_id_send_by');
            $table->integer('pay_level');
            $table->string('position', 50);
            $table->integer('status');
            $table->integer('order_id');
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
        Schema::dropIfExists('team_bussiness');
    }
}
