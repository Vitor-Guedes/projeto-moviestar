<?php

use Guedes\Moviestar\Controllers\{
    IndexController,
    AccountController,
    Account\LoginController,
    Account\RegisterController,
    Account\DashboardController,
    Account\LogoutController,
    Account\UpdatePasswordController,
    Account\Profile\EditController as ProfileEditController,
    Account\Profile\UpdateController as ProfileUpdateController,
    Account\Profile\ViewController as ProfileViewController,
    Movie\AddController,
    Movie\StoreController,
    Movie\ShowController,
    Movie\EditController,
    Movie\UpdateController,
    Review\StoreController as ReviewStoreController
};
use Guedes\Moviestar\Controllers\Movie\ViewController;
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
    $group->get('/movie/edit/{id}', EditController::class)->setName('movie.edit');
    $group->post('/movie/update/{id}', UpdateController::class)->setName('movie.update');

    $group->post('/review/store', ReviewStoreController::class)->setName('review.store');
    $group->get('/edit/profile', ProfileEditController::class)->setName('user.edit-profile');
    $group->post('/update/profile', ProfileUpdateController::class)->setName('user.update-profile');
    $group->post('/update/password', UpdatePasswordController::class)->setName('user.update-password');
})->add(new AuthMiddleware($container));

$app->group('/movie', function ($group) {
    $group->get('/view/{id}', ViewController::class)->setName('movie.view');
});
$app->get('/profile/{id}', ProfileViewController::Class)->setName('user.profile');