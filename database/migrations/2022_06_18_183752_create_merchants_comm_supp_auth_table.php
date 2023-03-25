<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsCommSuppAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants_comm_supp_auth', function (Blueprint $table) {
            $table->integer('id');
            $table->string('merchant_id', 20);
            $table->string('r_l_e_name', 50);
            $table->string('e_reg_no', 30);
            $table->string('s_tax_no', 50);
            $table->string('s_e_goods', 20);
            $table->string('pan_no', 20);
            $table->string('pan_proof', 100);
            $table->string('tan', 20);
            $table->string('t_proof', 100);
            $table->string('vt_no', 100);
            $table->string('vt_proof', 100);
            $table->string('cst_no', 100);
            $table->string('cst_proof', 100);
            $table->string('vrg_date', 30);
            $table->string('cst_rg_dt', 30);
            $table->string('brfa_sign', 100);
            $table->string('ci_crt', 100);
            $table->string('a_prf', 100);
            $table->string('can_chq', 100);
            $table->string('as_si_name', 100);
            $table->string('as_si_desi', 100);
            $table->string('as_si_email', 100);
            $table->string('as_si_mob', 100);
            $table->string('as_si_scnd_cpy', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchants_comm_supp_auth');
    }
}
