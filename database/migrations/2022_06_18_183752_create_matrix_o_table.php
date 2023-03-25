<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatrixOTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matrix_o', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->integer('parent_id');
            $table->integer('direct_id');
            $table->integer('children');
            $table->timestamp('rdate')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matrix_o');
    }
}
