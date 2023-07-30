<?php

namespace Guedes\Moviestar\Controllers\Account;

use DI\Container;
use Guedes\Moviestar\Services\UserService;
use Slim\Routing\RouteContext;

class RegisterController
{
    protected $userService;

    protected $flash;

    public function __construct(UserService $userService, Container $container)
    {
        $this->userService = $userService;
        $this->flash = $container->get('flash');
    }

    public function __invoke($request, $response)
    {
        $data = $request->getParsedBody();

        $newUser = $this->userService->create($data);

        if (is_string($newUser)) {
            $this->flash->addMessage('error', $newUser);

            $routerContext = RouteContext::fromRequest($request);
            $routerParse = $routerContext->getRouteParser();
            $location = $routerParse->urlFor('account');
            return $response->withHeader('Location', $location)
                ->withStatus(302);
        }

        return $response;
    }
}