<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('f_name', 50);
            $table->string('l_name', 50);
            $table->string('email', 100);
            $table->string('pass_word', 50);
            $table->string('tr_pin', 50);
            $table->string('parent_customer_id', 15);
            $table->string('customer_id', 15);
            $table->string('direct_customer_id', 15);
            $table->string('position', 8);
            $table->string('phone', 15);
            $table->string('bsacode', 50);
            $table->string('rank', 50)->default('Associate');
            $table->integer('percentage');
            $table->string('image', 100);
            $table->string('gender', 8);
            $table->string('dob', 15);
            $table->string('address', 150);
            $table->string('city', 100);
            $table->string('state', 80);
            $table->string('country', 50);
            $table->integer('pincode');
            $table->string('nominee', 50);
            $table->string('nominee_rel', 50);
            $table->string('nominee_dob', 25);
            $table->string('pancard', 50);
            $table->string('panimage', 100);
            $table->string('applied_pan', 3);
            $table->string('aadhar', 50);
            $table->string('aadharimage', 100);
            $table->string('b_aadhar_img');
            $table->string('applied_aadhar', 3);
            $table->string('bank_name', 50);
            $table->string('bank_img');
            $table->string('back_adhar_img');
            $table->string('bank_prof_img');
            $table->string('branch', 50);
            $table->string('account_name', 20);
            $table->string('account_type', 20);
            $table->string('account_no', 50);
            $table->string('bank_city', 50);
            $table->string('bank_state', 50);
            $table->string('ifsc', 50);
            $table->string('status', 10);
            $table->string('var_status', 10);
            $table->string('repurchase', 10)->default('no');
            $table->float('bliss_amount', 10, 0)->default(0);
            $table->integer('points');
            $table->integer('reward_wallet');
            $table->integer('cashback_amount');
            $table->tinyInteger('user_level')->default(0);
            $table->integer('capping');
            $table->tinyInteger('consume')->default(0);
            $table->integer('direct');
            $table->integer('left_direct');
            $table->integer('right_direct');
            $table->float('sbv', 10);
            $table->integer('package')->default(0);
            $table->string('package_used', 50);
            $table->integer('franchise');
            $table->integer('booster');
            $table->integer('reward');
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
        Schema::dropIfExists('customer');
    }
}
