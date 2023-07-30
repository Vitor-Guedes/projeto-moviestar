<?php

namespace Guedes\Moviestar\Controllers\Account;

use Guedes\Moviestar\Services\UserService;

class LoginController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;    
    }

    public function __invoke($request, $response)
    {
        $data = $request->getParsedBody();

        $authenticated = $this->userService
            ->authenticate(
                $data['email'],
                $data['password']
            );

        if ($authenticated) {
            var_dump(123);
        }

        return $response;
    }
}