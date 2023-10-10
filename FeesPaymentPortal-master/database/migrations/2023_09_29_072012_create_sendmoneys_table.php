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
        Schema::create('sendmoneys', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_reference');
            $table->string('status');
            $table->string('id_from_API')->nullable();
            $table->string('rec_first_name')->nullable();
            $table->string('rec_surname')->nullable();
            $table->string('rec_house_number')->nullable();
            $table->string('rec_area')->nullable();
            $table->string('rec_city')->nullable();
            $table->string('country')->nullable();
            $table->string('fees_amount')->nullable();
            $table->string('charged_amount')->nullable();
            $table->string('credited_amount')->nullable();
            $table->string('principal_amount')->nullable();
            $table->string('recipient_account_uri')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('modified_by')->references('id')->on('users');
            $table->decimal('amount', 10, 2);
   
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
        Schema::dropIfExists('sendmoneys');
    }
};
