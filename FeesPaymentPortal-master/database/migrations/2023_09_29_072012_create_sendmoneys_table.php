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
           
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sendmoneys');
    }
};