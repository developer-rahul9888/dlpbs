<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFranchisePinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franchise_pin', function (Blueprint $table) {
            $table->integer('fid', true);
            $table->string('user_id', 25);
            $table->float('amount', 10, 0);
            $table->string('package', 50);
            $table->string('status', 20);
            $table->timestamp('edate')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('franchise_pin');
    }
}
