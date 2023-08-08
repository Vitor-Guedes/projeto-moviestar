<?php

namespace Guedes\Moviestar\Controllers\Movie;

use Guedes\Moviestar\Services\MovieService;
use Slim\Views\Twig;

class EditController
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;    
    }

    public function __invoke($request, $response, $args)
    {
        $movie = $this->movieService->getMovieById($args['id']);
        $view = Twig::fromRequest($request);
        return $view->render($response, 'editmovie.php', compact('movie'));
    }
}