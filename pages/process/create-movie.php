<?php

require_once(DAO_DIR . '/MovieDAO.php');

$userData = $userDao->verifyToken();

$title = $_POST['title'];
$description = $_POST['description'];
$trailer = $_POST['trailer'];
$category = $_POST['category'];
$length = $_POST['length'];

if (empty($title) || empty($description) || empty($category)) {
    (new Message(BASE_URL))->setMessage(
        'Você precisa adicionar pelo menos: title, descrição e categoria',
        'error',
        'back'
    );
}

$movie = new Movie();
$movie->title = $title;
$movie->description = $description;
$movie->trailer = $trailer;
$movie->category = $category;
$movie->length = $length;
$movie->user_id = $userData->id;

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

$movieDao = new MovieDAO($connection, BASE_URL);
$movieDao->create($movie);