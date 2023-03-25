<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonanzaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonanza', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('lbv');
            $table->integer('rbv');
            $table->string('rank', 50);
            $table->string('reward', 250);
            $table->string('status', 250);
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
        Schema::dropIfExists('bonanza');
    }
}
