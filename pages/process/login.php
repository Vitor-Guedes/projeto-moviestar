<?php

$email = $_POST['email'];
$password = $_POST['password'];

if ($userDao->authenticateUser($email, $password)) {
    (new Message(BASE_URL))->setMessage(
        'Seja bem-vindo!',
        'success',
        '/edit/profile'
    ); 
}