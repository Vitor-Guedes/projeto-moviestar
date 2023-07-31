<?php

use Guedes\Moviestar\Controllers\{
    IndexController,
    AccountController,
    Account\LoginController,
    Account\RegisterController,
    Account\DashboardController
};
use Guedes\Moviestar\Middleware\AuthMiddleware;

// Define app routes
$app->get('/', IndexController::class)->setName('home');
$app->get('/account', AccountController::class)->setName('account');
$app->post('/login', LoginController::class)->setName('login');
$app->post('/register', RegisterController::class)->setName('register');
$app->get('/dashboard', DashboardController::class)->setName('dashboard')->add(new AuthMiddleware($container));