<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSleepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sleeps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_account_id')->nullable();
            $table->time('shallow_sleep')->nullable();
            $table->time('deep_sleep')->nullable();
            $table->time('wake_up_times')->nullable();
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
        Schema::dropIfExists('sleeps');
    }
}
