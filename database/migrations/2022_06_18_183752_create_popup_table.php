<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popup', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title');
            $table->string('name');
            $table->string('image');
            $table->string('description');
            $table->string('type', 50);
            $table->string('status', 50);
            $table->timestamp('date', 6)->default('current_timestamp(6)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('popup');
    }
}
