<?php

namespace App\Kernal\DataBase;

use App\Kernal\Config\ConfigInteface;

class  DataBase implements DataBaseInteface
{
    private \PDO $pdo;

    public function __construct(
        private ConfigInteface $config
    ) {
        $this->coonect();
    }

    public function inserta(string $table, array $data): int|false
    {
        return false;
    }

    private function coonect(): void
    {
        $driver = $this->config->get('database.driver');
        $host = $this->config->get('database.host');
        $port = $this->config->get('database.port');
        $database = $this->config->get('database.database');
        $username = $this->config->get('database.username');
        $password = $this->config->get('database.password');
        $charset = $this->config->get('database.charset');

        try {
            $this->pdo = new \PDO("$driver:host=$host;port=$port;dbname=$database;charset=$charset", $username, $password);
        } catch (\PDOException $th) {
            exit ("Database connection failed: ".$th ->getMessage());
        }
    }
}