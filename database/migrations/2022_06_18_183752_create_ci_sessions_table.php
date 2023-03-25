<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ci_sessions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('data');
            $table->text('timestamp');
            $table->string('ip_address', 45)->default('0');
            $table->string('user_agent', 120);
            $table->unsignedInteger('last_activity')->default(0)->index('last_activity_idx');
            $table->text('user_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ci_sessions');
    }
}
