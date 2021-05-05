<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('account_id')->nullable();
            $table->uuid('group_id')->nullable();
            $table->string('band_address')->unique()->nullable();
            $table->string('account_type')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('status')->default('not-infected');
            $table->string('blood_pressure_filter')->default('true');
            $table->string('heart_rate_filter')->default('true');
            $table->string('fatigue_filter')->default('true');
            $table->string('blood_oxygen_filter')->default('true');
            $table->string('provider_id')->nullable();
            $table->string('password')->nullable();
            $table->string('image')->nullable();
            $table->string('gender')->nullable();
            $table->string('gender_show')->nullable();
            $table->integer('age')->nullable();
            $table->string('age_show')->nullable();
            $table->integer('height')->nullable();
            $table->string('height_show')->nullable();
            $table->string('height_unit')->nullable();
            $table->integer('weight')->nullable();
            $table->string('weight_show')->nullable();
            $table->string('weight_unit')->nullable();
            $table->integer('temperature')->nullable();
            $table->string('temperature_unit')->nullable();
            $table->integer('step_length')->nullable();
            $table->string('step_length_unit')->nullable();
            $table->string('wear_side')->nullable();
            $table->integer('personal_goal')->nullable();
            $table->string('questionnaire_assigned')->nullable();
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
        Schema::dropIfExists('user_accounts');
    }
}
