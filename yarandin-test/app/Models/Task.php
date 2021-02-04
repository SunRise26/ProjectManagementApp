<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['creator_id', 'project_id', 'status_id', 'title', 'description', 'position'];

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
