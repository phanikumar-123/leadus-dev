<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SubscpPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscp_plans')->insert([
            'plan_name' => 'Introductry Offer',
            'plan_total_price' => 0,
            'plan_monthly_selling_price' => 0,
            'plan_type' => 'free',
            'plan_validity' => 3,
            'offer_msg' => 'Free (First 3 Days)',
            'is_plan_active' => true
        ]);
        DB::table('subscp_plans')->insert([
            'plan_name' => '1 Month',
            'plan_total_price' => 99,
            'plan_monthly_selling_price' => 99,
            'plan_monthly_cost_price' => 99,
            'plan_validity' => 30,
            'plan_type' => 'paid',
            'is_plan_active' => true
        ]);
        DB::table('subscp_plans')->insert([
            'plan_name' => '6 Months',
            'plan_total_price' => 499,
            'plan_monthly_selling_price' => 83,
            'plan_monthly_cost_price' => 99,
            'plan_validity' => 180,
            'plan_type' => 'paid',
            'is_plan_active' => true
        ]);
        DB::table('subscp_plans')->insert([
            'plan_name' => '1 Year',
            'plan_total_price' => 799,
            'plan_monthly_selling_price' => 66,
            'plan_monthly_cost_price' => 99,
            'plan_validity' => 365,
            'plan_type' => 'paid',
            'is_plan_active' => true
        ]);
    }
}
