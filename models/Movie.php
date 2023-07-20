<?php

class Movie 
{
    public $id;
    public $title;
    public $description;
    public $image;
    public $trailer;
    public $category;
    public $length;
    public $user_id;

    public $rating;

    public function imageGenerateName()
    {
        return 'movie-' . bin2hex(random_bytes(60)) . '.jpeg';
    }

    public function getImageMovie()
    {
        if ($this->image) {
            return BASE_URL . '/images/movies/' . $this->image;
        }
        return BASE_URL . '/images/movies/movie_cover.jpg';
    }
}

interface MovieDAOInterface
{
    public function buildMovie($data);
    public function findAll();
    public function getLastMovies();
    public function getMoviesByCategory($category);
    public function getMoviesByUserId($userId);
    public function findById($id);
    public function findByTitle($title);
    public function create(Movie $movie);
    public function update(Movie $movie);
    public function destroy($id);
}