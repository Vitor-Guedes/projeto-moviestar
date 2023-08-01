<?php

use Guedes\Moviestar\Controllers\{
    IndexController,
    AccountController,
    Account\LoginController,
    Account\RegisterController,
    Account\DashboardController,
    Account\LogoutController,
    Movie\AddController,
    Movie\StoreController,
    Movie\ShowController,
    Movie\EditController,
    Movie\UpdateController,
};
use Guedes\Moviestar\Middleware\AuthMiddleware;
use Slim\Routing\RouteCollectorProxy;

// Define app routes
$app->get('/', IndexController::class)->setName('home');
$app->get('/account', AccountController::class)->setName('account');
$app->post('/login', LoginController::class)->setName('login');
$app->post('/register', RegisterController::class)->setName('register');

$app->group('/user', function (RouteCollectorProxy $group) {
    $group->get('/dashboard', DashboardController::class)->setName('dashboard');
    $group->get('/logout', LogoutController::class)->setName('logout');
    $group->get('/movie/add', AddController::class)->setName('movie.add');
    $group->post('/movie/store', StoreController::class)->setName('movie.store');
    $group->get('/movie/show/{id}', ShowController::class)->setName('movie.show');
    $group->get('/movie/edit/{id}', EditController::class)->setName('movie.edit'); /// continuar daqui
    $group->post('/movie/update/{id}', UpdateController::class)->setName('movie.update'); /// continuar daqui
})->add(new AuthMiddleware($container));