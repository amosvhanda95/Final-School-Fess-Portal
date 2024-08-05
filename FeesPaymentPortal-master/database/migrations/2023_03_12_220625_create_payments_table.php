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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('school_id')->unsigned()->index();
            $table->bigInteger('branch_id')->unsigned()->index();
            $table->bigInteger('bank_account_id')->unsigned()->index();
            $table->foreign('school_id')->references('id')->on('schools');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('bank_account_id')->references('id')->on('school_bank_accounts');
            $table->double('amount');
            $table->string('amount_in_words');
    
            $table->string('payment_method')->nullable();
            $table->string('reg_number')->nullable();
            $table->string('semester')->nullable();
            $table->integer('term')->nullable();
            $table->string('class')->nullable();
            $table->integer('year')->nullable();
            $table->string('purpose')->nullable();
            $table->string('reference_number');
            $table->date('paid_at')->nullable();
            $table->string('depositor_name')->nullable();
            $table->string('student_name');
            $table->string('currency_value');
            $table->string('rrn')->nullable();
            $table->string('payment_status');
            $table->integer("status");
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
        Schema::dropIfExists('payments');
    }
};
