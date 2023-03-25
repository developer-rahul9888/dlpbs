<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGndNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gnd_news', function (Blueprint $table) {
            $table->tinyInteger('id', true);
            $table->string('title', 500);
            $table->text('discription');
            $table->string('type', 50);
            $table->string('visibility', 10)->default('in');
            $table->string('image');
            $table->string('status', 20)->default('deactive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gnd_news');
    }
}
