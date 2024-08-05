<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sendmoneys', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_reference');
            $table->string('status');
            $table->string('charged_amount')->nullable();
            $table->string('fees_amount')->nullable();
            $table->string('credited_amount')->nullable();
            $table->string('principal_amount')->nullable();
            $table->string('amountsent')->nullable();
            $table->string('recipient_account_uri')->nullable();
            $table->string('sender_account_uri')->nullable(); // Add this field
            $table->decimal('payment_amount', 10, 2)->nullable(); // Add this field
            $table->string('payment_origination_country')->nullable(); // Add this field
            $table->string('fx_rate')->nullable(); // Add this field
            $table->string('bank_code')->nullable(); // Add this field
            $table->string('currency')->nullable();
            $table->string('payment_type')->nullable(); // Add this field
            $table->string('source_of_income')->nullable(); // Add this field
            $table->string('settlement_details')->nullable(); // Add this field
            $table->string('cashout_code')->nullable(); // Add this field
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('modified_by');
            $table->foreign('modified_by')->references('id')->on('users');
             // Sender details
             // Sender details
             $table->string('sender_first_name')->nullable();
             $table->string('sender_last_name')->nullable();
             $table->date('sender_date_of_birth')->nullable();
             $table->string('sender_house_number')->nullable();
             $table->string('sender_address_area')->nullable();
             $table->string('sender_city')->nullable();
             $table->string('sender_phone_number')->nullable();
             $table->string('sender_id')->nullable();
             
             // Recipient details
             $table->string('recipient_first_name')->nullable();
             $table->string('recipient_last_name')->nullable();
             $table->string('recipient_house_number')->nullable();
             $table->string('recipient_address_area')->nullable();
             $table->string('recipient_city')->nullable();
             $table->string('recipient_phone')->nullable();
             $table->string('receive_currency')->nullable();
             $table->decimal('amount', 15, 2)->nullable();
             $table->string('recipient_id')->nullable();
             $table->string('recipient_email')->nullable();
             $table->string('recipient_gender')->nullable();
           
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sendmoneys');
    }
};