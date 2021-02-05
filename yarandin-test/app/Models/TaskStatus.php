<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    public static function getSortedList() {
        return TaskStatus::orderBy('position')->get();
    }

    public function getTranslatedTitle(bool $original = false) {
        $code = $original ? $this->getOriginal('code') : $this->code;
        return trans("task_status.$code");
    }
}
