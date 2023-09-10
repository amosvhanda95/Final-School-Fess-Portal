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
        Schema::create('school_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('school_id')->unsigned()->index();
            $table->foreign('school_id')->references('id')->on('schools');
            $table->bigInteger('account_number');
            $table->string('currency')->default('ZWD');
            $table->boolean('status');
            $table->bigInteger('created_by')->unsigned()->index();
            $table->bigInteger('modified_by')->unsigned()->index();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('modified_by')->references('id')->on('users');
            
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
        Schema::dropIfExists('school_bank_accounts');
    }
};
