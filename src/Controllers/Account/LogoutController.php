<?php

namespace Guedes\Moviestar\Controllers\Account;

use DI\Container;
use Guedes\Moviestar\Services\UserService;
use Guedes\Moviestar\Traits\UrlFor;

class LogoutController
{
    use UrlFor;

    protected $userService;

    protected $flash;

    public function __construct(UserService $userService, Container $container)
    {
        $this->userService = $userService;
        $this->flash = $container->get('flash');
    }

    public function __invoke($request, $response)
    {
        $this->userService->destroyToken();

        $redirect = $this->urlFor('home', $request);
        $this->flash->addMessage('success', 'Você fez o logout com sucesso!');
        return $response->withHeader('Location', $redirect)
            ->withStatus(301);
    }
}