<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinsTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pins_transfer', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('pinid')->default('');
            $table->string('status', 50)->default('0');
            $table->string('amount')->default('');
            $table->string('pin_type');
            $table->string('assign_to')->default('');
            $table->string('assign_from')->default('');
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
        Schema::dropIfExists('pins_transfer');
    }
}
