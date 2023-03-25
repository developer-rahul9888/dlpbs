<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepurchaseBvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repurchase_bv', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->float('lbv', 10);
            $table->float('rbv', 10);
            $table->float('sbv', 10);
            $table->integer('plcount');
            $table->integer('prcount');
            $table->timestamp('rdate')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repurchase_bv');
    }
}
