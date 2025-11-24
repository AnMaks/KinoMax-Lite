<?php

namespace App\Kernal\Upload;


interface UploadFileInterface
{
    public function move(string $path, string $fileName = null): string|false;

    public function getExtation(): string;
}