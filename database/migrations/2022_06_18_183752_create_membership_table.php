<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email_addres')->nullable()->unique('email_addres');
            $table->string('user_name')->nullable()->unique('user_name');
            $table->string('pass_word', 200)->nullable();
            $table->integer('user_level');
            $table->timestamp('register_date')->useCurrent();
            $table->string('phone', 15);
            $table->integer('permission');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membership');
    }
}
