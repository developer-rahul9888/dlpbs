<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_coupon', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title', 400);
            $table->string('code', 20)->unique('code');
            $table->string('amount', 50);
            $table->string('type', 20);
            $table->string('start_date', 20);
            $table->string('end_date', 20);
            $table->integer('per_user');
            $table->string('status', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_coupon');
    }
}
