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
        Schema::create('fxrates', function (Blueprint $table) {
            $table->id();
            $table->string('country')->nullable();
            $table->string('country_code')->nullable();
            $table->string('currency')->nullable();
            $table->decimal('rate', 20, 6)->nullable();
            $table->string('card_rate_id')->nullable();
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
        Schema::dropIfExists('fxrates');
    }
};
