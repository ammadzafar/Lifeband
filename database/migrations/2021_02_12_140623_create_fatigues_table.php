<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFatiguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fatigues', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_account_id')->nullable();
            $table->integer('value')->nullable();
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
        Schema::dropIfExists('fatigues');
    }
}
