<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpgradeAccTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upgrade_acc', function (Blueprint $table) {
            $table->integer('up_id', true);
            $table->integer('up_user_id');
            $table->string('user_email', 50);
            $table->string('up_status', 15)->default('pending');
            $table->string('req_for', 20);
            $table->timestamp('rdate')->useCurrentOnUpdate()->useCurrent();
            $table->string('req_apr_date', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upgrade_acc');
    }
}
