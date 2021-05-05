<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodOxygensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_oxygens', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_account_id')->nullable();
            $table->float('value')->nullable();
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
        Schema::dropIfExists('blood_oxygens');
    }
}
