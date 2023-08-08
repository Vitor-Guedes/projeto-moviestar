<?php

namespace Guedes\Moviestar\Services;

use Exception;
use Guedes\Moviestar\Models\MongoDB\Review;

class ReviewService
{
    protected $review;

    public function __construct(Review $review)
    {
        $this->review = $review;    
    }   

    public function create(array $data = [])
    {
        $storeResult = $this->review->create($data);

        if ($storeResult->getInsertedCount()) {
            $review = $this->review->buildReview($data);
            $review->id = $storeResult->getInsertedId();
            return $review;
        }

        throw new Exception('Error ao tentar inserir o comentario.');
    }

    public function hasAlreadyReviwed(string $movieId, string $userId)
    {
        return $this->review->hasAlreadyReviwed($movieId, $userId);
    }

    public function getRatings(string $movieId)
    {
        return $this->review->getRatings($movieId);
    }

    public function getMovieReview(string $movieId)
    {
        return $this->review->getMovieReview($movieId);
    }
}