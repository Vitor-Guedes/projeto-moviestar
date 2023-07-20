<?php

    $userData = $userDao->verifyToken(true);
        
    require_once(DAO_DIR . '/MovieDAO.php');

    $movieDao = new MovieDAO($connection, BASE_URL);

    $id = $_POST['id'];
    $movie = $movieDao->findById($id);

    if (!$movie || $movie->user_id !== $userData->id) {
        (new Message(BASE_URL))->setMessage(
            'Informações inválidas',
            'error',
            '/'
        );
    }

    $movieDao->destroy($movie->id);