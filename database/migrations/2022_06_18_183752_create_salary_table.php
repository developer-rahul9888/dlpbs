<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->integer('amount');
            $table->integer('tmonth');
            $table->text('description');
            $table->string('type', 50);
            $table->string('status', 10);
            $table->timestamp('pay_date')->useCurrent();
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
        Schema::dropIfExists('salary');
    }
}
