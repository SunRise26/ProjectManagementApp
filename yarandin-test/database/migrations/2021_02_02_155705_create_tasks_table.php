<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->foreignId('status_id')->constrained('task_statuses');
            $table->timestamps();
        });

        // Laravel doesn't support full text search migration
        DB::statement('ALTER TABLE `tasks` ADD FULLTEXT INDEX task_description_index (description)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function ($table) {
            $table->dropIndex('task_description_index');
        });
        Schema::dropIfExists('tasks');
    }
}
