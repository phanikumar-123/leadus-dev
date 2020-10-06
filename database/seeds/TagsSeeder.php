<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->truncate();

        DB::table('tags')->insert([
            'name' => 'History'
        ]);
        DB::table('tags')->insert([
            'name' => 'Geography'
        ]);
        DB::table('tags')->insert([
            'name' => 'Arts'
        ]);
        DB::table('tags')->insert([
            'name' => 'Computer Science'
        ]);
        DB::table('tags')->insert([
            'name' => 'Civics'
        ]);
    }
}
