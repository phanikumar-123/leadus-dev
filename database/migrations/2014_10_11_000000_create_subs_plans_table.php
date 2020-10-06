<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubsPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscp_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name');
            $table->float('plan_total_price');
            $table->float('plan_monthly_selling_price');
            $table->float('plan_monthly_cost_price')->nullable();
            $table->string('plan_type');
            $table->integer('plan_validity');
            $table->string('offer_msg')->nullable();
            $table->boolean('is_plan_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscp_plans');
    }
}
