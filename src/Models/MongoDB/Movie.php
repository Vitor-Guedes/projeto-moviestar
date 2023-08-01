<?php

namespace Guedes\Moviestar\Models\MongoDB;

use DI\Container;

class Movie
{
    protected $container;
    protected $mongo;
    protected $database = 'moviestar';
    protected $collection = 'movies';

    public $id;
    public $title;
    public $description;
    public $image;
    public $trailer;
    public $category;
    public $length;
    public $user_id;
    public $rating;

    public function __construct(Container $container)
    {
        $this->container = $container;    
    }

    protected function getConnection()
    {
        if (!$this->mongo) {
            $this->mongo = $this->container->get('mongo');
        }
        return $this->mongo;
    }

    protected function getCollection()
    {
        $database = $this->database;
        $collection = $this->collection;
        return $this->getConnection()->$database->$collection;
    }

    public function buildMovie(array $data)
    {
        $this->id = $data['id'] ?? (string) $data['_id'];
        $this->title = $data['title'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->image = $data['image'] ?? '';
        $this->trailer = $data['trailer'] ?? '';
        $this->category = $data['category'] ?? '';
        $this->length = $data['length'] ?? '';
        $this->rating = $data['rating'] ?? '';
        return $this;
    }

    public function create(array $data = [])
    {
        return $this->getCollection()->insertOne($data);
    }

    public function getMoviesByUserId(string $id)
    {
        $result = $this->getCollection()->find(['user_id' => $id]);
        $movies = [];
        foreach ($result as $item) {
            $movie = clone $this;
            $movies[] = $movie->buildMovie((array) $item);
        }
        return $movies;
    }

    public function getMovieById(string $id)
    {
        $data = $this->getCollection()->findOne([
            '_id' => new \MongoDB\Bson\ObjectId($id)
        ]);
        return !$data ? false : $this->buildMovie((array) $data);
    }

    public function getImageMovie()
    {
        return $this->image;
    }
}