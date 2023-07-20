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
    '/process/update-password' => '/process/update-password.php',
    '/process/create-movie' => '/process/create-movie.php',
    '/movie-view' => '/movie.php',
    '/process/update/movie' => '/process/update-movie.php',
    '/process/movie/delete' => '/process/delete-movie.php',
    '/edit-movie' => '/edit-movie.php',
    '/profile' => '/profile.php',
    '/process/review' => '/process/review.php',
    '/search' => '/search.php'
];

if (in_array('movie', explode('/', $requestUri)) && !isset($views[$requestUri])) {
    $movieRequest = array_filter(explode('/', $requestUri));

    $template = array_shift($movieRequest);
    $movieId = array_shift($movieRequest);

    $requestUri = '/movie-view';
}

if (in_array('edit-movie', explode('/', $requestUri)) && !isset($views[$requestUri])) {
    $movieRequest = array_filter(explode('/', $requestUri));

    $template = array_shift($movieRequest);
    $movieId = array_shift($movieRequest);

    $requestUri = '/edit-movie';
}

if (in_array('profile', explode('/', $requestUri)) && !isset($views[$requestUri])) {
    $profileRequest = array_filter(explode('/', $requestUri));

    $template = array_shift($profileRequest);
    $userId = array_shift($profileRequest);

    $requestUri = '/profile';
}

if (in_array('/search', array_values(parse_url($requestUri)))) {
    $requestUri = '/search';
}

$template = isset($views[$requestUri]) ? $views[$requestUri] : '/404.php';

$template = PAGES_DIR . $template;

if (!file_exists($template)) {
    $template = PAGES_DIR . '/404.php';
}