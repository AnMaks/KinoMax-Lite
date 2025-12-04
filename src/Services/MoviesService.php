<?php

namespace App\Services;

use App\Kernal\DataBase\DataBaseInteface;
use App\Kernal\Upload\UploadFileInterface;
use App\Model\Category;
use App\Model\Movie;

class MoviesService
{
    public function __construct(
        private DataBaseInteface $db,
    ) {}

    /**
     * @return array<Movie>
     */
    public function all(): array
{
    $movies = $this->db->get('movies');

    return array_map(function ($movie) {
        return new Movie(
            $movie['id'],
            (int)$movie['category_id'],   // ← categoryid (int)
            $movie['name'],               // ← name (string)
            $movie['description'],        // ← description (string)
            $movie['preview'],            // ← preview (string)
            $movie['created_at'],          
        );
    }, $movies);
}



    public function destroy(int $id): void
    {
        $this->db->delete('movies', [
            'id' => $id
        ]);
    }

    public function store(string $name, string $description, UploadFileInterface $image, int $category): false|int
    {
        $filePath = $image->move('movies');

        return $this->db->inserta('movies', [
            'name' => $name,
            'description' => $description,
            'preview' => $filePath,
            'category_id' => $category,
        ]);
    }

    public function find(int $id): ?Movie
    {
        $movies = $this->db->first('movies', [
            'id' => $id
        ]);

        if (! $movies) {
            return null;
        }
        return new Movie(
            id: $movies['id'],
            categoryid: $movies['category_id'],
            name: $movies['name'],
            description: $movies['description'],
            preview: $movies['preview'],
            created_at: $movies['created_at'],
        );
    }

    public function update(int $id, string $name, string $description, ?UploadFileInterface $image, int $category): void
    {
        
        $data = [
            'name' => $name,
            'description' => $description,
            'category_id' => $category,
        ];

        if ($image && ! $image->hasError()) {
            $data['preview'] = $image->move('movies');
        }

        $this->db->update('movies', $data, [
            'id' => $id,
        ]);

    }

    public function new()
    {
        $movies = $this ->db ->get('movies',[], ['id' => 'DESC'], 5);

        return array_map(function ($movie) {
            return new Movie(
                $movie['id'],
                $movie['category_id'],
                $movie['name'],
                $movie['description'],
                $movie['preview'],
                $movie['created_at'],
            );
        }, $movies);

    }
}