<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['creator_id', 'title', 'description', 'position'];

    public function tasks() {
        return $this->hasMany(Task::class)
            ->orderBy('position', 'ASC')
            ->orderBy('created_at', 'DESC');
    }

    /**
     * @param mixed $userId
     * @return Collection
     */
    public static function getUserList($userId): Collection
    {
        return Project::where('creator_id', $userId)
            ->orderBy('position', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * @param mixed $userId
     * @param mixed $projectId
     * @return Project
     */
    public static function getUserProject($userId, $projectId): Project
    {
        return Project::where('creator_id', $userId)->findOrFail($projectId);
    }
}
