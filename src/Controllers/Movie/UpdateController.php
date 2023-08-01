<?php

namespace Guedes\Moviestar\Controllers\Movie;

use DI\Container;
use Exception;
use Guedes\Moviestar\Services\MovieService;
use Guedes\Moviestar\Traits\Image;
use Guedes\Moviestar\Traits\UrlFor;

class UpdateController
{
    use UrlFor;
    use Image;

    protected $movieService;

    protected $flash;

    protected $user;

    public function __construct(MovieService $movieService, Container $container)
    {
        $this->movieService = $movieService;
        $this->flash = $container->get('flash');
        $this->user = $container->get('user');
    }

    public function __invoke($request, $response, $args)
    {
        try {
            $redirect = $_SERVER['HTTP_REFERER'];
            $data = $this->validateData($request->getParsedBody());
            $data['user_id'] = $this->user->id;

            if ($request->getUploadedFiles()) {
                $data['image'] = $this->storeImage($request, 'movies');
            }

            $movie = $this->movieService->getMovieById($args['id']);
            $movie->buildMovie($data);
            $this->movieService->update($movie);
            $this->flash->addMessage('success', 'Filme atualizado com sucesso!');
            return $response->withHeader("Location", $redirect)
                ->withStatus(302);
        } catch (Exception $e) {
            $this->flash->addMessage('error', $e->getMessage());
            return $response->withHeader("Location", $redirect)
                ->withStatus(302);
        }
    }

    public function validateData(array $data = [])
    {
        if (empty(['title']) || empty(['descriprion']) || empty(['category'])) {
            throw new Exception('Você precisa adicionar pelo menos: title, descrição e categoria.');
        }

        return $data;
    }
}