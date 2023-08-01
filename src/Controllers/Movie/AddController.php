<?php

namespace Guedes\Moviestar\Controllers\Movie;

use Slim\Views\Twig;

class AddController
{
    public function __invoke($request, $response)
    {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'newmovie.php');
    }
}