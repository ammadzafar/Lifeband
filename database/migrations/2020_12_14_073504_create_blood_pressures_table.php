<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodPressuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_pressures', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_account_id')->nullable();
            $table->float('high_value')->nullable();
            $table->float('low_value')->nullable();
            $table->string('show')->nullable();
            $table->dateTime('date_time')->nullable();
            $table->softDeletes('deleted_at')->nullable();
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
        Schema::dropIfExists('blood_pressures');
    }
}
