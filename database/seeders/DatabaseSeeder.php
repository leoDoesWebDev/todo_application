<?php

namespace Database\Seeders;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todo')->insert([
            'task' => 'Pop to the shops',
            'description' => 'Buy eggs, milk, butter, flour, peppers, ham, cheese and bread',
            'complete_by' => '2021-05-20',
            'status' => 0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('todo')->insert([
            'task' => 'Complete todo application',
            'description' => 'Create a todo application that demonstrates MVC knowledge',
            'complete_by' => '2021-05-10',
            'status' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
