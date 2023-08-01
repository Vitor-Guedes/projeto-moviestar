<?php

namespace Guedes\Moviestar\Services;

use Exception;
use Guedes\Moviestar\Models\MongoDB\Movie;

class MovieService
{
    protected $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;    
    }

    public function create(array $data)
    {
        $storeResult = $this->movie->create($data);

        if ($storeResult->getInsertedCount()) {
            $movie = $this->movie->buildMovie($data);
            $movie->id = $storeResult->getInsertedId();
            return $movie;
        }

        throw new Exception('Error ao tentar inserir o filme.');
    }

    public function getMoviesByUserId(string $id)
    {
        return $this->movie->getMoviesByUserId($id);
    }

    public function getMovieById(string $id)
    {
        return $this->movie->getMovieById($id);
    }
}