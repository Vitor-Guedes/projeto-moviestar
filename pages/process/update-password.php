<?php

$userData = $userDao->verifyToken();

$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];

if ($password != $confirmpassword) {
    (new Message(BASE_URL))->setMessage(
        'As senhas não são iguais!',
        'error',
        'back'
    );
}

$userData->password = $userData->generatePassword($password);
$userDao->changePassword($userData);