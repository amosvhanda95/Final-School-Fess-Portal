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
        Schema::create('zsspayments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('regnumber');
            $table->string('amount');
            $table->string('refference')->unique();
            $table->string('status');
            $table->string('bank_account_number');
            $table->string('year');
            $table->string('semester');
            $table->string('purpose');
            $table->string('transaction_number');
            $table->string('currency');
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
        Schema::dropIfExists('zsspayments');
    }
    
};
