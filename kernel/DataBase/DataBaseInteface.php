<?php

namespace App\Kernal\DataBase;


interface DataBaseInteface
{


    public function inserta(string $table, array $data): int|false;
}
