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
            Schema::create('transactions', function (Blueprint $table) {
                $table->id();
                $table->decimal('amount', 15, 2);
                $table->string('bdxBranch');
                $table->string('city');
                $table->string('countryCode');
                $table->string('countryName');
                $table->string('currencyCode');
                $table->string('district');
                $table->string('gender');
                $table->string('internationalPartnerCode');
                $table->string('internationalPartnerName');
                $table->string('nationalId');
                $table->string('operatorName');
                $table->string('originalReference');
                $table->string('recipientName');
                $table->string('senderName');
                $table->string('sourceOfFundsCode');
                $table->string('street');
                $table->string('suburb');
                $table->string('transactionDate');
                $table->string('transactionPurposeCode');
                $table->string('transactionType');
                $table->string('transferMode');
                $table->string('status');
                $table->timestamps();
            });
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
