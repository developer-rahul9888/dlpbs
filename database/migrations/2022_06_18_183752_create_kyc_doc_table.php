<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKycDocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kyc_doc', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('user_id');
            $table->string('photo_graph', 200);
            $table->string('pan_card', 200);
            $table->string('aadhar_gst', 200);
            $table->string('mail_doc', 200);
            $table->string('pass_book_cheque', 200);
            $table->string('product_id1');
            $table->string('product_id2');
            $table->string('product_id3');
            $table->string('product_id4');
            $table->string('product_id5');
            $table->string('mail_doc_type', 200);
            $table->date('c_date');
            $table->date('e_date');
            $table->integer('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kyc_doc');
    }
}
