<?php

namespace Guedes\Moviestar\Controllers\Account\Profile;

use Guedes\Moviestar\Services\UserService;
use Slim\Views\Twig;

class ViewController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;    
    }

    public function __invoke($request, $response, $args)
    {
        $_user = $this->userService->fingById($args['id']);
        $view = Twig::fromRequest($request);
        return $view->render($response, 'view-profile.php', compact('_user'));
    }
}