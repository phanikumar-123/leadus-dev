<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('otp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('otp');
            $table->unsignedBigInteger('uid');
            $table->timestamps();
        });

        Schema::table('otp', function (Blueprint $table) {
            $table->foreign('uid')->references('id')->on('users');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('otp');
    }
}
