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
        $fields = array_keys($data);



        $columns = implode(', ', $fields);
        $binds = implode(', ', array_map(fn($field) => ":$field", $fields));

        $sql = "INSERT INTO $table ($columns) VALUES ($binds)";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (\PDOException $th) {
            return false;
        }

        return (int) $this->pdo->lastInsertId();
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
            exit("Database connection failed: " . $th->getMessage());
        }
    }

    public function first(string $table, array $conditions = []): ?array
    {
        $where = '';
        $params = [];

        if (count($conditions) > 0) {

            $where = 'WHERE ' . implode(' AND ', array_map(function ($field) use (&$params, $conditions) {
                $params[":$field"] = $conditions[$field];
                return "$field = :$field";
            }, array_keys($conditions)));
        }

        $sql = "SELECT * FROM $table $where LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    public function get(string $table, array $conditions = []): array
    {
         $where = '';
        $params = [];

        if (count($conditions) > 0) {

            $where = 'WHERE ' . implode(' AND ', array_map(function ($field) use (&$params, $conditions) {
                $params[":$field"] = $conditions[$field];
                return "$field = :$field";
            }, array_keys($conditions)));
        }

        $sql = "SELECT * FROM $table $where";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function delete(string $table, array $conditions = []): void
    {
         $where = '';
        $params = [];

        if (count($conditions) > 0) {

            $where = 'WHERE ' . implode(' AND ', array_map(function ($field) use (&$params, $conditions) {
                $params[":$field"] = $conditions[$field];
                return "$field = :$field";
            }, array_keys($conditions)));
        }

        $sql = "DELETE FROM $table $where";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
    }

    public function update(string $table, array $data, array $conditions = []): void
{
    $fields = array_keys($data);

    // SET
    $set = implode(', ', array_map(fn($field) => "$field = :$field", $fields));

    $where = '';
    $conditionParams = [];

    if (count($conditions) > 0) {
        $whereParts = [];
        foreach ($conditions as $field => $value) {
            $param = "cond_$field"; // префикс cond_
            $whereParts[] = "$field = :$param";
            $conditionParams[$param] = $value;
        }
        $where = 'WHERE ' . implode(' AND ', $whereParts);
    }

    $sql = "UPDATE $table SET $set $where";

    $stmt = $this->pdo->prepare($sql);

    // объединяем данные и условия с разными плейсхолдерами
    $stmt->execute(array_merge($data, $conditionParams));
}

}