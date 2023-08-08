<?php

namespace Guedes\Moviestar\Controllers\Account;

use DI\Container;
use Exception;
use Guedes\Moviestar\Services\UserService;
use Guedes\Moviestar\Traits\Image;
use Guedes\Moviestar\Traits\UrlFor;

class UpdatePasswordController
{
    use UrlFor;

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
            $data = $this->validateData($request->getParsedBody());
         
            $user = $this->userService->verifyToken();
            $user = $user->buildUser($data);
            $user->password = $user->generatePassword($data['password']);
            $this->userService->update($user);

            $this->flash->addMessage('success', 'Senha atualizado com sucesso!');
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
        if ($data['password'] !== $data['confirmpassword']) {
            throw new Exception('As senhas não são iguais!');
        }

        return $data;
    }
}