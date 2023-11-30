<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('rec_first_name')->nullable();
            $table->string('rec_surname')->nullable();
            $table->string('rec_house_number')->nullable();
            $table->string('rec_area')->nullable();
            $table->string('rec_city')->nullable();
            $table->string('recipient_account_uri')->nullable();
            $table->string('rec_ban')->nullable();
            $table->string('rec_iban')->nullable();
            $table->string('rec_email')->nullable();
            $table->string('rec_ewallet')->nullable();
            $table->string('rec_pan')->nullable();
            $table->string('rec_bic')->nullable();
            $table->string('rec_bank_name')->nullable();
            $table->string('rec_bank_type')->nullable();
            $table->string('rec_bank_code')->nullable();
            $table->string('payer_payee_relationship')->nullable();
            $table->string('rec_country_subdivision')->nullable();
            $table->string('rec_middle_name')->nullable();
            $table->string('rec_postal_code')->nullable();
            $table->string('id_expiration_date')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('currency')->nullable();
            $table->string('rec_idc')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('country_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('country_id')->references('id')->on('fxrates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficiaries');
    }
};
