<?php

$userData = $userDao->verifyToken();

$userData->name = $_POST['name'];
$userData->lastname = $_POST['lastname'];
$userData->email = $_POST['email'];
$userData->bio = $_POST['bio'];

if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
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

    $imageName = $userData->imageGenerateName();

    imagejpeg($imageFile, IMAGES_DIR . '/users/'. $imageName, 100);
    $userData->image = $imageName;
}

$userDao->update($userData);