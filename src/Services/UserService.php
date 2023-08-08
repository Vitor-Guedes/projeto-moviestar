<?php

namespace Guedes\Moviestar\Services;

use Exception;
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
        $data['password'] = $this->user->generatePassword($data['password']);
        $data['token'] = $this->user->generateToken();

        $storeResult = $this->user->create($data);

        if ($storeResult->getInsertedCount()) {
            $user = $this->user->buildUser($data);
            $user->id = $storeResult->getInsertedId();
            return $user;
        }
        
        throw new Exception('Error ao tentar inserir o email.');
    }

    public function verifyToken()
    {
        if ($token = $_SESSION['token']) {
            return $this->user->findByToken($token);
        }
        return false;
    }

    public function destroyToken()
    {
        $_SESSION['token'] = '';
        return true;
    }

    public function authenticate(array $credentials = [])
    {
        try {
            $user = $this->findByEmail($credentials['email']);
            if ($user && password_verify($credentials['password'], $user->password)) {
                $user->token = $user->generateToken();
                $_SESSION['token'] = $user->token;
                return $this->update($user);
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function findByEmail(string $email)
    {
        return $this->user->findByEmail($email);
    }

    public function findByToken(string $token)
    {
        return $this->user->findByToken($token);
    }

    public function fingById(string $id)
    {
        return $this->user->fingById($id);
    }

    public function update(User $user)
    {
        return $user->update();
    }
}