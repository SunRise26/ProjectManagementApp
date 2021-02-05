<?php

namespace App\Models;

use App\Events\TaskUpdated;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'updated' => TaskUpdated::class,
    ];

    protected $fillable = [
        'creator_id',
        'project_id',
        'status_id',
        'title',
        'description',
        'position',
        'attached_file_id'
    ];

    public function file() {
        return $this->hasOne(File::class, 'id', 'attached_file_id');
    }

    public function saveFile($attachedFile)
    {
        $file = File::saveUploadedFile($attachedFile, null, 'uploads/task/' . $this->id);

        $this->update(['attached_file_id' => $file->id]);
    }

    public function getFileLink()
    {
        return route('user.task_attachment', $this->id);
    }

    /**
     * @param mixed $userId
     * @return Collection
     */
    public static function getUserList($userId): Collection
    {
        return Task::where('creator_id', $userId)
            ->orderBy('position', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * @param mixed $userId
     * @param mixed $taskId
     * @return Task
     */
    public static function getUserTask($userId, $taskId): Task
    {
        return Task::where('creator_id', $userId)->findOrFail($taskId);
    }
}
