<?php

namespace Guedes\Moviestar\Controllers\Review;

use Exception;
use DI\Container;
use Guedes\Moviestar\Traits\UrlFor;
use Guedes\Moviestar\Services\ReviewService;

class StoreController
{
    use UrlFor;

    protected $reviewService;

    protected $flash;

    protected $user;

    public function __construct(ReviewService $reviewService, Container $container)
    {
        $this->reviewService = $reviewService;
        $this->flash = $container->get('flash');
        $this->user = $container->get('user');
    }

    public function __invoke($request, $response)
    {
        try {
            $redirect = $_SERVER['HTTP_REFERER'];
            $data = $this->validateData($request->getParsedBody());
            $data['user_id'] = $this->user->id;
            $this->reviewService->create($data);

            $this->flash->addMessage('success', 'Comenário adicionado!');
            return $response->withHeader('Location', $redirect)
                ->withStatus(301);
        } catch (Exception $e) {
            $this->flash->addMessage('error', $e->getMessage());
            return $response->withHeader('Location', $redirect)
                ->withStatus(302);
        }
    }

    protected function validateData(array $data = [])
    {
        if (!$data['rating'] || !$data['review']) {
            throw new Exception('Você precisa inserir nota e comentario!');
        }
        return $data;
    }
}