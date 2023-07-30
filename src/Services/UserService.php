<?php

namespace Guedes\Moviestar\Services;

use Guedes\Moviestar\Models\MongoDB\User;

class UserService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;    
    }

    public function create(array $data = [])
    {
        return $this->user->create($data);
    }

    public function authenticate(string $email, string $password)
    {
        $user = $this->user->findByEmail($email);
        return true;
    }
}