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
        ModelsTaskStatus::firstOrNew(['code' => 'new', 'position' => 0])->save();
        ModelsTaskStatus::firstOrNew(['code' => 'in_progress', 'position' => 1])->save();
        ModelsTaskStatus::firstOrNew(['code' => 'done', 'position' => 2])->save();
    }
}
