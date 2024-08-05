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
        Schema::create('ethix_transactions', function (Blueprint $table) {
            $table->id();
           
            $table->string('TellerEthixUsername');
            $table->string('schoolAccountNumber');
            $table->string('posTransactionReference');
            $table->string('description');
            $table->decimal('amount', 15, 2);
            $table->string('currency');
            $table->string('status')->default('pending'); // Adding status column 
           
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
        Schema::dropIfExists('ethix_transactions');
    }
};
