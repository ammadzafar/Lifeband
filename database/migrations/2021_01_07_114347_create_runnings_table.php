<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRunningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('runnings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_account_id')->nullable();
            $table->time('minutes_per_km')->nullable();
            $table->time('time')->nullable();
            $table->float('distance')->nullable();
            $table->integer('kcal_burned')->nullable();
            $table->integer('steps')->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('runnings');
    }
}
