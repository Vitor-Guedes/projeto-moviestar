<?php

namespace Guedes\Moviestar\Controllers;

use Slim\Views\Twig;

class IndexController
{
    public function __invoke($request, $response)
    {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'index.php');
    }
}