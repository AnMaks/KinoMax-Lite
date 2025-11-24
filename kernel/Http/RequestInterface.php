<?php

namespace App\Kernal\Http;

use App\Kernal\Upload\UploadFileInterface;
use App\Kernal\Validator\Validator;
use App\Kernal\Validator\ValidatorInterface;

interface RequestInterface
{
    public static function createFromGlobal(): static;

    public function uri(): string;

    public function method(): string;

    public function input(string $key, $default = null): mixed;

    public function file(string $key): ?UploadFileInterface;

    public function setValidator(ValidatorInterface $validator): void;

    public function validate(array $rules): bool;

    public function errors(): array;
}