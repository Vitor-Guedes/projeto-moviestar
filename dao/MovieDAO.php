<?php

include_once(MODELS_DIR . '/Movie.php');
include_once(DAO_DIR . '/ReviewDAO.php');

class MovieDAO implements MovieDAOInterface
{
    protected $connection;

    protected $url;

    protected $message;

    protected $reviewDao;

    public function __construct($connection, $url)
    {
        $this->connection = $connection;
        $this->url = $url;
        $this->message = new Message($url);
        $this->reviewDao = new ReviewDao($connection, $url);
    }

    public function buildMovie($data)
    {
        $movie = new Movie();
        $movie->id = $data['id'];
        $movie->title = $data['title'];
        $movie->description = $data['description'];
        $movie->image = $data['image'];
        $movie->trailer = $data['trailer'];
        $movie->category = $data['category'];
        $movie->length = $data['length'];
        $movie->user_id = $data['user_id'];

        $movie->rating = $this->reviewDao->getRatings($movie->id);

        return $movie;
    }

    public function findAll()
    {

    }

    public function getLastMovies()
    {
        $stmt = $this->connection->query('SELECT * FROM movies ORDER BY id DESC');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return array_map(function ($_movie) {
                return $this->buildMovie($_movie);
            }, $stmt->fetchAll());
        }
        return [];
    }

    public function getMoviesByCategory($category)
    {
        $stmt = $this->connection->prepare('SELECT * FROM movies WHERE category like :category');
        $stmt->bindParam(':category', $category);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return array_map(function ($_movie) {
                return $this->buildMovie($_movie);
            }, $stmt->fetchAll());
        }
        return [];
    }

    public function getMoviesByUserId($userId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM movies WHERE user_id like :user_id');
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return array_map(function ($_movie) {
                return $this->buildMovie($_movie);
            }, $stmt->fetchAll());
        }
        return [];
    }

    public function findById($id)
    {
        $stmt = $this->connection->prepare('SELECT * FROM movies WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount() > 0 ? $this->buildMovie($stmt->fetch()) : false;
    }

    public function findByTitle($title)
    {
        $stmt = $this->connection->prepare('SELECT * FROM movies WHERE title like :title');
        $stmt->bindParam(':title', $title);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return array_map(function ($_movie) {
                return $this->buildMovie($_movie);
            }, $stmt->fetchAll());
        }
        return [];
    }

    public function create(Movie $movie)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO movies (
                title, description, image, trailer, category, length, user_id
            ) VALUES (
                :title, :description, :image, :trailer, :category, :length, :user_id
            )");
        
            $stmt->bindParam(':title', $movie->title);
            $stmt->bindParam(':description', $movie->description);
            $stmt->bindParam(':image', $movie->image);
            $stmt->bindParam(':trailer', $movie->trailer);
            $stmt->bindParam(':category', $movie->category);
            $stmt->bindParam(':length', $movie->length);
            $stmt->bindParam(':user_id', $movie->user_id);
    
            $stmt->execute();
    
            $this->message->setMessage(
                'Filme adicionado com sucesso!',
                'success',
                '/'
            );
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update(Movie $movie)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE movies SET 
                title = :title, 
                description = :description, 
                image = :image, 
                trailer = :trailer, 
                category = :category, 
                length = :length
            WHERE id = :id");
            
            $stmt->bindParam(':title', $movie->title);
            $stmt->bindParam(':description', $movie->description);
            $stmt->bindParam(':image', $movie->image);
            $stmt->bindParam(':trailer', $movie->trailer);
            $stmt->bindParam(':category', $movie->category);
            $stmt->bindParam(':length', $movie->length);
            $stmt->bindParam(':id', $movie->id);

            $stmt->execute();

            $this->message->setMessage(
                'Filme com sucess!',
                'success',
                '/dashboard'
            );
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function destroy($id)
    {
        $stmt = $this->connection->prepare('DELETE FROM movies WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $this->message->setMessage(
            'Filme deletado com sucesso!',
            'success',
            'back'
        );
    }
}