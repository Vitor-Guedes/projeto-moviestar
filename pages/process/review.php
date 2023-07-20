<?php
    include_once(DAO_DIR . '/ReviewDAO.php');
    require_once(DAO_DIR . '/MovieDAO.php');

    $reviewDao = new ReviewDao($connection, BASE_URL);
    $movieDao = new MovieDAO($connection, BASE_URL);
    
    $userData = $userDao->verifyToken(true);

    $movieId = $_POST['movie_id'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    if (!$rating && !$review) {
        (new Message(BASE_URL))->setMessage(
            'Você precisa inserir nota e comentario!',
            'error',
            'back'
        );
    }

    if (!($movieData = $movieDao->findById($movieId))) {
        (new Message(BASE_URL))->setMessage(
            'Dados inválidos!',
            'error',
            'back'
        );
    }

    $reviewData = new Review();
    $reviewData->rating = $rating;
    $reviewData->review = $review;
    $reviewData->user_id = $userData->id;
    $reviewData->movie_id = $movieData->id;
    
    $reviewDao->create($reviewData);