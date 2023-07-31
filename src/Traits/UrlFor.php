<?php

namespace Guedes\Moviestar\Traits;

use Slim\Routing\RouteContext;

trait UrlFor
{
    protected function urlFor(string $route, $request)
    {
        $routerContext = RouteContext::fromRequest($request);
        $routerParse = $routerContext->getRouteParser();
        return $routerParse->urlFor($route);
    }
}