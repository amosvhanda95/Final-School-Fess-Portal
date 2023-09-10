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
        Schema::create('school_bursars', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('mobile_number');
            $table->bigInteger('school_id')->unsigned()->index();
            $table->foreign('school_id')->references('id')->on('schools');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('school_bursars');
    }
};
