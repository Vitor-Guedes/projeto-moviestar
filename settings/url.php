<?php

$http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";  

$host = $_SERVER['HTTP_HOST'];

$requestUri = $_SERVER['REQUEST_URI'];

define('BASE_URL', $http . $host);

$views = [
    '/' => '/home.php',
    '/auth' => '/auth.php',
    '/setup-db' => '/setupdb.php',
    '/process/login' => '/process/login.php',
    '/process/register' => '/process/register.php',
    '/edit/profile' => '/edit-profile.php',
    '/logout' => '/process/logout.php',
    '/dashboard' => '/dashboard.php',
    '/newmovie' => '/new-movie.php',
    '/process/update-user' => '/process/update-user.php',
    '/process/update-password' => '/process/update-password.php'
];

$template = isset($views[$requestUri]) ? $views[$requestUri] : '/404.php';

$template = PAGES_DIR . $template;

if (!file_exists($template)) {
    $template = PAGES_DIR . '/404.php';
}