<?php

namespace Guedes\Moviestar\Controllers\Account\Profile;

use Slim\Views\Twig;

class EditController
{
    public function __invoke($request, $response)
    {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'edit-profile.php');
    }
}