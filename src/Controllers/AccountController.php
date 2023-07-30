<?php

namespace Guedes\Moviestar\Controllers;

use Slim\Views\Twig;

class AccountController
{
    public function __invoke($request, $response)
    {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'account.php');
    }
}