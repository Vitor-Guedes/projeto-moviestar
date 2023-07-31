<?php

namespace Guedes\Moviestar\Controllers\Account;

use Exception;
use DI\Container;
use Guedes\Moviestar\Traits\UrlFor;
use Guedes\Moviestar\Services\UserService;

class RegisterController
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
        try {
            $redirect = $this->urlFor('dashboard', $request);
            $data = $this->validateData($request->getParsedBody());
            $user = $this->userService->create($data);

            $_SESSION['token'] = $user->token;
            $this->flash->addMessage('success', 'Seja Bem-vindo!');
            return $response->withHeader("Location", $redirect)
                ->withStatus(301);
        } catch (Exception $e) {
            $redirect = $this->urlFor('account', $request);
            $this->flash->addMessage('error', $e->getMessage());
            return $response->withHeader("Location", $redirect)
                ->withStatus(302);
        }
    }

    protected function validateData(array $data)
    {
        if (!$data['name'] || !$data['lastname'] || !$data['password'] || !$data['confirmpassword']) {
            throw new Exception('Por favor preencha todos os campos.');
        }

        if ($data['password'] != $data['confirmpassword']) {
            throw new Exception('A senha e a confirmação precisam ser iguais.');
        }

        if ($this->userService->findByEmail($data['email'])) {
            throw new Exception('Usuário já cadastrado, tente outro email.');
        }

        return $data;
    }
}