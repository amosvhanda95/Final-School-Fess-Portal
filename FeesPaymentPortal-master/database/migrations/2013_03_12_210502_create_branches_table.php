<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Branch;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('branch_name');
            $table->string('branch_address');
            $table->string('email')->nullable();
            $table->string('mobile_number')->nullable();;
            $table->timestamps();
        });
        Branch::create([
            'branch_name'=>'Harare',
            'branch_address'=>'Corner 3rd, Causeway Building, And Central Ave, Harare',

        ]);
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
    }
};
