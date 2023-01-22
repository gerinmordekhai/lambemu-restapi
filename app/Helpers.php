<?php

use Illuminate\Support\Facades\Storage;

function filePath($file)
{
    $extension = $file->extension();
    $fileName = 'profile'.'_'.'picture'.'_'.uniqid().$extension;
    $path = Storage::putFileAs('public/image/profile', $file , $fileName);
    $link = Storage::url($path);
    $file = $link;

    return $file;
}