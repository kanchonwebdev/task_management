<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [];

        for ($i = 1; $i <= 30; $i++) {
            $tasks[] = [
                'title' => "Task $i",
                'description' => "Description for Task $i",
                'status' => ['pending', 'in progress', 'completed'][array_rand(['pending', 'in progress', 'completed'])],
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('tasks')->insert($tasks);
    }
}
