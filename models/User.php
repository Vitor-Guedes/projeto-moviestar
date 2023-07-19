<?php

class User {
    public $id;
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $image;
    public $bio;
    public $token;

    public function generateToken()
    {
        return bin2hex(random_bytes(50));
    }

    public function generatePassword(string $password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function imageGenerateName()
    {
        return 'user-' . bin2hex(random_bytes(60)) . '.jpeg';
    }

    public function getFullName()
    {
        return implode(' ', [$this->name, $this->lastname]);
    }

    public function getImageUser()
    {
        if ($this->image) {
            return BASE_URL . '/images/users/' . $this->image;
        }
        return BASE_URL . '/images/users/user.png';
    }
}

interface UserDAOInterface {
    public function buildUser(array $data = []);
    public function create(User $user, $authUser = false);
    public function update(User $user, $redirect = true);
    public function verifyToken($protected = false);
    public function setTokenToSession($token, $redirect = true);
    public function authenticateUser($email, $password);
    public function findByToken($token);
    public function findByEmail($email);
    public function findById($id);
    public function changePassword(User $user);
    public function destroyToken(User $user);
}