<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'name', 'file_path'];

    public static function saveUploadedFile(UploadedFile $resourse, $fileName = null, $path = null)
    {
        $title = $resourse->getClientOriginalName();
        $fileName = $fileName ?: time() . '_' . $title;
        $path = $path ?: "uploads";

        $savedFilePath = $resourse->storeAs($path, $fileName, ['disk' => 'local']);

        try {
            $file = File::create([
                'title' => $title,
                'name' => $fileName,
                'file_path' => $path
            ]);
            throw new Exception("qwe");
        } catch (Exception $e) {
            Storage::disk('local')->delete($savedFilePath);
        }

        return $file;
    }
}
