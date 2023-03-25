<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->integer('level_1');
            $table->integer('level_2');
            $table->integer('level_3');
            $table->integer('level_4');
            $table->integer('level_5');
            $table->integer('level_6');
            $table->integer('level_7');
            $table->integer('level_8');
            $table->integer('level_9');
            $table->integer('level_10');
            $table->integer('level_11');
            $table->integer('matrix_id');
            $table->string('status');
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
        Schema::dropIfExists('children');
    }
}
