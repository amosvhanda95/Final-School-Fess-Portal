<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->bigInteger('branch_id')->unsigned()->index();
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->integer('type')->unsigned()->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        User::create([
            'first_name'=>'Amos',
            'last_name'=>'Vhanda',
            'email'=>'amosvhanda@gmail.com',
            'branch_id'=>'1',
            'type'=>'1',
            'password'=>Hash::make('admin'),

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
