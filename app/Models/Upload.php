<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Upload extends Model
{
    protected $fillable = [
        'file_name', 'size', 'original_name', 'uploadable_type', 'extension', 'uploadable_id'
    ];

    private $allowedFileTypes = ['png', 'jpg', 'jpeg', 'csv'];

    public function uploadable()
    {
        return $this->morphTo();
    }

    public function saveFile($file, $uploadable)
    {
        $name = $file->getClientOriginalName();
        $encryptedName = sha1(date('YmdHis') . $name);
        $extension = $file->getClientOriginalExtension();
        $path = $file->getPath() . '/' . $file->getFilename();
        $size = $file->getSize();
        $data = file_get_contents($path);
        if ($this->validateExtension($extension, $name)) {
            return null;
        }

        $filePath = $this->filesPath . $encryptedName . '.' . $extension;
        Storage::disk('public')->put('images/' . $filePath, $data);

        $upload = new Upload();
        $upload->file_name = $encryptedName . '.' . $extension;
        $upload->size = $size;
        $upload->original_name = $name;
        $upload->extension = '.'.pathinfo($name, PATHINFO_EXTENSION);
        $upload->uploadable_id = $uploadable->id;
        $upload->uploadable_type = get_class($uploadable);
        $upload->save();
    }

    private function validateExtension($extension, $name)
    {
        if (!in_array(strtolower($extension), $this->allowedFileTypes)) {
            return true;
        }
        return false;
    }
}
