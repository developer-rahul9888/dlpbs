<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkwithTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workwith', function (Blueprint $table) {
            $table->integer('id_no', true);
            $table->string('Sitename', 30);
            $table->string('link', 400);
            $table->string('zkey', 100);
            $table->string('username', 300);
            $table->string('phno', 15);
            $table->string('ip', 50);
            $table->string('city', 100);
            $table->string('visitor_no', 20);
            $table->timestamp('Date_Time')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workwith');
    }
}
