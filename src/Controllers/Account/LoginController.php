<?php

namespace Guedes\Moviestar\Controllers\Account;

use DI\Container;
use Guedes\Moviestar\Services\UserService;
use Guedes\Moviestar\Traits\UrlFor;

class LoginController
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
        $credentials = $request->getParsedBody();
        $user = $this->userService->authenticate($credentials);
        if ($user) {
            $redirect = $this->urlFor('dashboard', $request);
            return $response->withHeader('Location', $redirect)
                ->withStatus(301);
        }

        $this->flash->addMessage('error', 'Email ou password inválido!');
        $redirect = $this->urlFor('account', $request);
        return $response->withHeader('Location', $redirect)
            ->withStatus(302);
    }
}