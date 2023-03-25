<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePincodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pincodes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('status');
            $table->string('city_type', 10);
            $table->integer('pincode');
            $table->integer('active');
            $table->string('state_code', 10);
            $table->string('city', 50);
            $table->string('dccode', 50);
            $table->string('route', 50);
            $table->string('state', 50);
            $table->string('date_of_discontinuance', 50);
            $table->string('city_code', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pincodes');
    }
}
