<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantQueryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_query', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name', 150);
            $table->string('email', 150);
            $table->string('subject', 200);
            $table->text('message');
            $table->timestamp('sdate')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_query');
    }
}
