<?php

namespace Guedes\Moviestar\Models\MongoDB;

use DI\Container;

class Review
{
    protected $container;
    protected $mongo;
    protected $database = 'moviestar';
    protected $collection = 'reviews';

    public $id;
    public $rating;
    public $review;
    public $user_id;
    public $movie_id;

    public $user;

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

    public function buildReview($data)
    {
        $this->id = $data['id'] ?? (string) $data['_id'];
        $this->rating = $data['rating'];
        $this->review = $data['review'];
        $this->user_id = $data['user_id'];
        $this->movie_id = $data['movie_id'];
        return $this;
    }

    public function create(array $data = [])
    {
        return $this->getCollection()->insertOne($data);
    }

    public function hasAlreadyReviwed($movieId, $userId)
    {
        $data = $this->getCollection()->findOne([
            'movie_id' => $movieId,
            'user_id' => $userId
        ]);
        return $data ?? false;
    }

    public function getMovieReview($movieId)
    {
        $result = $this->getCollection()->find(['movie_id' => $movieId]);
        $reviews = [];
        foreach ($result as $item) {
            $review = clone $this;
            $reviews[] = $review->buildReview((array) $item);

            $user = $this->container->get('userService')->fingById($review->user_id);
            $review->user = $user;
        }
        return $reviews;
    }

    public function getRatings($movieId)
    {
        $reviews = $this->getMovieReview($movieId);
        if ($reviews) {
            $rating = array_reduce($reviews, function ($_rating, $_review) {
                return $_rating + $_review->rating;
            });
            return intval($rating / count($reviews));
        }
        return 'Não aváliado';
    }

    public function toArray()
    {
        $data = [
            'id' => $this->id,
            'rating' => $this->rating,
            'review' => $this->review,
            'user_id' => $this->user_id,
            'movie_id' => $this->movie_id
        ];

        return array_filter($data, function ($attribute) {
            return ! empty($attribute);
        });
    }
}