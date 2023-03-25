<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pin_request', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name');
            $table->string('customer_id');
            $table->string('email');
            $table->string('tr_pin');
            $table->string('amount');
            $table->string('phone');
            $table->string('bank_name');
            $table->string('bank_branch');
            $table->string('account_no');
            $table->string('ifsc_code');
            $table->string('neft');
            $table->string('image');
            $table->string('pins');
            $table->string('package');
            $table->text('comment');
            $table->text('reply');
            $table->string('status');
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
        Schema::dropIfExists('pin_request');
    }
}
