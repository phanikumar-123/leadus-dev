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
            $table->string('first_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('contact');
            $table->string('password');
            $table->string('profile_photo')->nullable();
            $table->unsignedBigInteger('active_plan')->nullable();
            $table->timestamp('plan_expires_on')->nullable();
            $table->boolean('free_plan_applicable')->default(true);
            $table->unsignedBigInteger('user_role');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users', function(Blueprint $table) {
            $table->foreign('active_plan')->references('id')->on('subscp_plans');
            $table->foreign('user_role')->references('id')->on('user_roles');
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
