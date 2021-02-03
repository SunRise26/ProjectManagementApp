<?php

namespace Database\Seeders;

use App\Models\TaskStatus as ModelsTaskStatus;
use Illuminate\Database\Seeder;

class TaskStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsTaskStatus::create(['code' => 'new', 'position' => 0]);
        ModelsTaskStatus::create(['code' => 'in_progress', 'position' => 1]);
        ModelsTaskStatus::create(['code' => 'done', 'position' => 2]);
    }
}
