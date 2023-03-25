<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorys', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('c_name', 100);
            $table->string('c_description', 500);
            $table->string('type');
            $table->string('image', 100);
            $table->text('icon');
            $table->string('position', 50);
            $table->string('status', 15)->default('active');
            $table->integer('p_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorys');
    }
}
