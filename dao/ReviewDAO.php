<?php

require_once(MODELS_DIR . '/Review.php');

class ReviewDao implements ReviewDAOInterdace
{
    protected $connection;

    protected $url;

    protected $message;

    protected $userDao;

    public function __construct($connection, $url)
    {
        $this->connection = $connection;
        $this->url = $url;
        $this->message = new Message($url);
        $this->userDao = new UserDAO($connection, $url);
    }

    public function buildReview($data)
    {
        $review = new Review();

        $review->id = $data['id'];
        $review->rating = $data['rating'];
        $review->review = $data['review'];
        $review->user_id = $data['user_id'];
        $review->movie_id = $data['movie_id'];

        return $review;
    }

    public function create(Review $review)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO reviews
                (rating, review, user_id, movie_id) 
            VALUES 
                (:rating, :review, :user_id, :movie_id)"
            );
    
            $stmt->bindParam(':rating', $review->rating);
            $stmt->bindParam(':review', $review->review);
            $stmt->bindParam(':user_id', $review->user_id);
            $stmt->bindParam(':movie_id', $review->movie_id);
    
            $stmt->execute();
    
            $this->message->setMessage(
                'Critica adicionado com sucesso!', 
                'success', 
                '/'
            );
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getMoviesReview($movieId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM reviews WHERE movie_id like :movie_id');
        $stmt->bindParam(':movie_id', $movieId);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return array_map(function ($_review) {
                $review = $this->buildReview($_review);
                
                $user = $this->userDao->findById($review->user_id);
                $review->user = $user;

                return $review;
            }, $stmt->fetchAll());
        }
        return [];
    }

    public function hasAlreadyReviwed($movieId, $userId)
    {
        $stmt = $this->connection->prepare("SELECT * FROM reviews 
            WHERE movie_id = :movie_id AND user_id = :user_id
        ");
        $stmt->bindParam(':movie_id', $movieId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function getRatings($movieId)
    {
        $reviews = $this->getMoviesReview($movieId);
        if ($reviews) {
            $rating = array_reduce($reviews, function ($_rating, $_review) {
                return $_rating + $_review->rating;
            });
            return intval($rating / count($reviews));
        }
        return 'Não aváliado';
    }
}