<?php

namespace Guedes\Moviestar\Controllers\Movie;

use DI\Container;
use Exception;
use Guedes\Moviestar\Services\MovieService;
use Guedes\Moviestar\Traits\Image;
use Guedes\Moviestar\Traits\UrlFor;

class StoreController
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

    public function __invoke($request, $response)
    {
        try {
            $redirect = $this->urlFor('movie.add', $request);
            $data = $this->validateData($request->getParsedBody());
            $data['user_id'] = $this->user->id;

            if ($request->getUploadedFiles()) {
                $data['image'] = $this->storeImage($request, 'movies');
            }

            $this->movieService->create($data);
            $this->flash->addMessage('success', 'Filme adicionado com sucesso!');
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