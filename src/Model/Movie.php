<?php

namespace App\Model;


class Movie
{
    public function __construct(
        private int $id,
        private int $categoryid,
        private string $name,
        private string $description,
        private string $preview,
    )
    {
    }

    public function categoryid():int
    {
        return $this ->categoryid;
    }
    
    public function id():int
    {
        return $this ->id;
    }

    public function description():string
    {
        return $this ->description;
    }

    public function preview():string
    {
        return $this ->preview;
    }

    public function name():string
    {
        return $this ->name;
    }
}