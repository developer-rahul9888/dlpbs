<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sco_links', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('url', 100);
            $table->string('title', 500);
            $table->string('discription', 500);
            $table->string('keywords', 500);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sco_links');
    }
}
