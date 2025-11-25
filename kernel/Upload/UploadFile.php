<?php

namespace App\Kernal\Upload;


class UploadFile implements UploadFileInterface
{
    public function __construct(
        public readonly string $name,
        public readonly string $type,
        public readonly string $tmpName,
        public readonly int $error,
        public readonly int $size,
    ) {}

    public function move(string $path, string $fileName = null): string|false
    {
        $storagePath = APP_PATH . "/storage/$path";

        if (! is_dir($storagePath)) {
            mkdir($storagePath, 0777, true);
        }

        $fileName = $fileName ?? $this->randomFileName();

        $filePath = "$storagePath/$fileName";

        if (move_uploaded_file($this->tmpName, $filePath)) {
            return "$path/$fileName";
        }

        return false;
    }


    public function randomFileName()
    {
        return md5(uniqid(rand(), true)) .'.'. $this->getExtation();
    }

    public function getExtation(): string
    {
        return pathinfo($this->name, PATHINFO_EXTENSION);
    }
}