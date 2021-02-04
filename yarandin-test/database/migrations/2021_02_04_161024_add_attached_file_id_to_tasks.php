<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddAttachedFileIdToTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('attached_file_id')->nullable();
        });

        DB::unprepared('
            CREATE TRIGGER tr_Task_Before_Delete
            BEFORE DELETE
            ON tasks FOR EACH ROW
            BEGIN
                DELETE FROM files WHERE files.id=OLD.attached_file_id;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('attached_file_id');
        });

        DB::unprepared('DROP TRIGGER `tr_Task_Before_Delete`');
    }
}
