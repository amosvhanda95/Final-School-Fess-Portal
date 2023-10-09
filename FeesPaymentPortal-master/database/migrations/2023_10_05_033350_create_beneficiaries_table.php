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
