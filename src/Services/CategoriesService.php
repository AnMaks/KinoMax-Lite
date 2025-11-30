<?php

namespace App\Services;

use App\Kernal\DataBase\DataBaseInteface;
use App\Model\Category;

class CategoriesService
{
    public function __construct(
        private DataBaseInteface $db,
    ) {}

    /**
     * @return array<Category>
     */
    public function all(): array
    {
        $categories = $this->db->get('categories');

        $categories = array_map(function ($category) {
            return new Category(
                id: $category['id'],
                name: $category['name'],
                created_at: $category['created_at'],
                updated_at: $category['updated_at']
            );
        }, $categories);

        return $categories;
    }

    public function delete(int $id): void
    {
        $this->db->delete('categories', [
            'id' => $id
        ]);
    }

    public function store(string $name): int
    {
        return $this->db->inserta('categories', [
            'name' => $name
        ]);
    }

    public function find(int $id): ?Category
    {
        $category = $this->db->first('categories', [
            'id' => $id
        ]);

        if (! $category) {
            return null;
        }
        return new Category(
            id: $category['id'],
            name: $category['name'],
            created_at: $category['created_at'],
            updated_at: $category['updated_at']
        );
    }

    public function update(int $id, string $name)
    {
        $this ->db ->update('categories', [
            'name' => $name,
        ],[
            'id' => $id
        ]);
    }
}