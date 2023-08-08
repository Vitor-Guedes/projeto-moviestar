<?php

namespace Guedes\Moviestar\Controllers\Account\Profile;

use Exception;
use DI\Container;
use Guedes\Moviestar\Traits\Image;
use Guedes\Moviestar\Traits\UrlFor;
use Guedes\Moviestar\Services\UserService;

class UpdateController
{
    use UrlFor;
    use Image;

    protected $userService;

    protected $flash;

    protected $user;

    public function __construct(UserService $userService, Container $container)
    {
        $this->userService = $userService;
        $this->flash = $container->get('flash');
        $this->user = $container->get('user');
    }

    public function __invoke($request, $response, $args)
    {
        try {
            $redirect = $_SERVER['HTTP_REFERER'];
            $data = $request->getParsedBody();

            $image = $request->getUploadedFiles()['image'];
            if ($image->getClientFilename()) {
                $data['image'] = $this->storeImage($request, 'users');
            }

            $user = $this->userService->verifyToken();
            $user = $user->buildUser($data);
            $this->userService->update($user);
            
            $this->flash->addMessage('success', 'Filme atualizado com sucesso!');
            return $response->withHeader("Location", $redirect)
                ->withStatus(302);
        } catch (Exception $e) {
            $this->flash->addMessage('error', $e->getMessage());
            return $response->withHeader("Location", $redirect)
                ->withStatus(302);
        }
    }
}