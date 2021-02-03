<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'position'];

    /**
     * @param mixed $userId
     * @return Collection
     */
    public static function getUserList($userId): Collection
    {
        return Project::where('user_id', $userId)
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
        return Project::where('user_id', $userId)->findOrFail($projectId);
    }
}
