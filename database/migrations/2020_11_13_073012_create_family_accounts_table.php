<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('admin_name');
            $table->string('image');
            $table->string('contact_no');
            $table->string('email');
            $table->integer('bands')->nullable();
            $table->string('emergency_contact');
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
        Schema::dropIfExists('family_accounts');
    }
}
