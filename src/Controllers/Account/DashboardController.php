<?php

namespace Guedes\Moviestar\Controllers\Account;

use Guedes\Moviestar\Traits\UrlFor;
use Slim\Views\Twig;

class DashboardController
{
    use UrlFor;

    public function __invoke($request, $response)
    {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'dashboard.php');
    }
}