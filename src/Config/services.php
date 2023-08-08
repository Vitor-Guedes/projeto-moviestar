<?php

/** @var \DI\Container $container */

use DI\Container;
use Guedes\Moviestar\Services\UserService;
use Guedes\Moviestar\Services\MovieService;
use Guedes\Moviestar\Services\ReviewService;
use MongoDB\Client;

$container->set('string_connection', function () {
    $data = [
        '%user' => getenv('MONGO_USER'),
        '%password' => getenv('MONGO_PASS'),
        '%host' => getenv('MONGO_HOST')
    ];
    $format = 'mongodb+srv://%user:%password@%host';
    return  str_replace(array_keys($data), array_values($data), $format);
});

$container->set('mongo', function (Container $container) {
    $stringConnection = $container->get('string_connection');
    return new Client($stringConnection);
});

$container->set('flash', function () {
    return new Slim\Flash\Messages();
});

$container->set('user', function () use ($container) {
    /** @var UserService $userService */
    $userService = $container->get(UserService::class);
    return $userService->verifyToken();
});

$container->set('movieService', function () use ($container) {
    return $container->get(MovieService::class);
});

$container->set('reviewService', function () use ($container) {
    return $container->get(ReviewService::class);
});

$container->set('userService', function () use ($container) {
    return $container->get(UserService::class);
});