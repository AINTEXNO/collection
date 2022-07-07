<?php


namespace App\Actions;


use Illuminate\Support\Str;

class StoreUploadFileAction
{
    public function __invoke($file): string
    {
        $filename = Str::random(30) . '_' . $file->getClientOriginalName();
        $file->storeAs('/public', $filename);

        return $filename;
    }
}
