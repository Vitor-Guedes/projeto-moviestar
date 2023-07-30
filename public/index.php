<?php

session_start();

require '../vendor/autoload.php';

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$containerBuilder = new ContainerBuilder();
$container = $containerBuilder->build();

require_once '../src/Config/services.php';

AppFactory::setContainer($container);
$app = AppFactory::create();

$container->set('app', $app);

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

require_once '../src/Routes/collection.php';

$twig = Twig::create('../src/Views/', ['cache' => false]);
$enviroment = $twig->getEnvironment();
$enviroment->addGlobal('flash', $container->get('flash'));

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));

// Run app
$app->run();