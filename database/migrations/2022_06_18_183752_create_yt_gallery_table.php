<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYtGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yt_gallery', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title');
            $table->string('url', 500);
            $table->string('description', 500);
            $table->string('type', 50);
            $table->string('status', 60);
            $table->timestamp('date')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yt_gallery');
    }
}
