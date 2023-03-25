<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebstoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webstores', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('web_name', 30);
            $table->string('category', 100);
            $table->string('web_dis', 1000);
            $table->string('web_s_dis', 500);
            $table->string('web_url', 200);
            $table->string('web_img', 200);
            $table->string('web_status', 10)->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webstores');
    }
}
