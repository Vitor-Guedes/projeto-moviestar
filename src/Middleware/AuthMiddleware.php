<?php

namespace Guedes\Moviestar\Middleware;

use Guedes\Moviestar\Services\UserService;
use Psr\Http\Message\ResponseInterface;
use Slim\Routing\RouteContext;

use function DI\value;

class AuthMiddleware
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;    
    }

    public function __invoke($request, $handler)
    {
        /** @var UserService $userService */
        $userService = $this->container->get(UserService::class);

        if (!$userService->verifyToken()) {
            $redirect = $this->urlFor('account', $request);
            $this->container->get('flash')
                ->addMessage('error', 'Faça a autenticação para acessar essa página!');
            $response = $this->container->get(\Slim\Psr7\Response::class);
            return $response->withHeader('Location', $redirect)
                ->withStatus(302);
        }

        return $handler->handle($request);
    }

    protected function urlFor(string $route, $request)
    {
        $routerContext = RouteContext::fromRequest($request);
        $routerParse = $routerContext->getRouteParser();
        return $routerParse->urlFor($route);
    }
}