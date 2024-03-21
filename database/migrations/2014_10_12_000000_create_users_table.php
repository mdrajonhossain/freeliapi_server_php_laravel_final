<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('otp')->default("0");
            $table->rememberToken();
            $table->timestamps();

            $table->string('firstname')->default("")->nullable();
            $table->string('lastname')->default("")->nullable();
            $table->string('phone')->default("0")->nullable();
            $table->json('device')->default("0")->nullable();
            $table->string('img')->default("img.png")->nullable();
            $table->string('is_active')->default("0")->nullable();
            $table->string('is_delete')->default("0")->nullable();
            $table->string('is_busy')->default("0")->nullable();
            $table->string('company_id')->default("0")->nullable();
            $table->json('connected_device')->default("0")->nullable();
            $table->string('gender')->default("")->nullable();
            $table->string('blood_group')->default("")->nullable();
            $table->string('nickname')->default("")->nullable();
            $table->string('present_address')->default("")->nullable();
            $table->string('permanent_address')->default("")->nullable();
            $table->string('father_name')->default("")->nullable();
            $table->string('mother_name')->default("")->nullable();
            $table->string('mute_all')->default("0")->nullable();
            $table->string('mute')->default("")->nullable();
        });
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
}