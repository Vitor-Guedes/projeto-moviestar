<?php

    $userData = $userDao->verifyToken(true);
        
    require_once(DAO_DIR . '/MovieDAO.php');

    $movieDao = new MovieDAO($connection, BASE_URL);

    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $trailer = $_POST['trailer'];
    $category = $_POST['category'];
    $length = $_POST['length'];

    $movie = $movieDao->findById($id);

    if (!$movie || $movie->user_id !== $userData->id) {
        (new Message(BASE_URL))->setMessage(
            'Informações inválidas',
            'error',
            '/'
        );
    }

    if (empty($title) || empty($description) || empty($category)) {
        (new Message(BASE_URL))->setMessage(
            'Você precisa adicionar pelo menos: title, descrição e categoria',
            'error',
            'back'
        );
    }

    if (isset($_FILES['image']) && $_FILES['image']['tmp_name']) {
        $image = $_FILES['image'];
        if (!in_array($image['type'], ['image/png', 'image/jpg', 'image/jpeg'])) {
            (new Message(BASE_URL))->setMessage(
                'Tipo de imagem inválido, insira png, jpg ou jpeg!',
                'error',
                'back'
            );
        }
        $imageFile = in_array($image['type'], ['image/jpg', 'image/jpeg']) 
            ? imagecreatefromjpeg($image['tmp_name'])
                : imagecreatefrompng($image['tmp_name']);

        $imageName = $movie->imageGenerateName();

        imagejpeg($imageFile, IMAGES_DIR . '/movies/'. $imageName, 100);
        $movie->image = $imageName;
    }

    $movie->title = $title;
    $movie->description = $description;
    $movie->trailer = $trailer;
    $movie->length = $title;
    $movie->category = $category;

    $movieDao->update($movie);