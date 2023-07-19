<?php

session_start();

$message = new Message(BASE_URL);

$flashMessages = $message->getMessage();
$message->clearMessage();

$userDao = new UserDAO($connection, BASE_URL);
$userData = $userDao->verifyToken(false);