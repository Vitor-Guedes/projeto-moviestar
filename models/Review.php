<?php

class Review
{
    public $id;
    public $rating;
    public $review;
    public $user_id;
    public $movie_id;

    public $user;
}

interface ReviewDAOInterdace
{
    public function buildReview($data);
    public function create(Review $review);
    public function getMoviesReview($movieId);
    public function hasAlreadyReviwed($movieId, $userId);
    public function getRatings($movieId);
}