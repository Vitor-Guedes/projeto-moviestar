<?php

namespace Guedes\Moviestar\Models\MongoDB;

use DI\Container;
use Guedes\Moviestar\Services\MovieService;

class User
{
    protected $container;
    protected $mongo;
    protected $database = 'moviestar';
    protected $collection = 'users';

    public $id;
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $image;
    public $bio;
    public $token;

    public function __construct(Container $container)
    {
        $this->container = $container;    
    }

    protected function getConnection()
    {
        if (!$this->mongo) {
            $this->mongo = $this->container->get('mongo');
        }
        return $this->mongo;
    }

    protected function getCollection()
    {
        $database = $this->database;
        $collection = $this->collection;
        return $this->getConnection()->$database->$collection;
    }

    public function buildUser(array $data)
    {
        $this->id = $data['id'] ?? (string) $data['_id'];
        $this->name = $data['name'] ?? '';
        $this->lastname = $data['lastname'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->image = $data['image'] ?? '';
        $this->bio = $data['bio'] ?? '';
        $this->token = $data['token'] ?? '';
        return $this;
    }

    public function create(array $data = [])
    {
        return $this->getCollection()->insertOne($data);
    }

    public function findByEmail(string $email)
    {
        $data = $this->getCollection()->findOne([
            'email' => $email
        ]);
        return !$data ? false : $this->buildUser((array) $data);
    }

    public function findByToken(string $token)
    {
        $data = $this->getCollection()->findOne([
            'token' => $token
        ]);
        return !$data ? false : $this->buildUser((array) $data);
    }

    public function generatePassword(string $password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function generateToken()
    {
        return bin2hex(random_bytes(50));
    }

    public function update()
    {
        $updateResult = $this->getCollection()
            ->updateOne([
                'email' => $this->email
            ], ['$set' => $this->toArray()]);
        
        return $updateResult->getModifiedCount() == 1
            && $updateResult->getMatchedCount() == 1
                ? $this 
                    : false;
    }

    public function toArray()
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'password' => $this->password,
            'image' => $this->image,
            'bio' => $this->bio,
            'token' => $this->token
        ];

        return array_filter($data, function ($attribute) {
            return ! empty($attribute);
        });
    }

    public function getMovies()
    {
        $movieServices = $this->container->get(MovieService::class);
        return $movieServices->getMoviesByUserId($this->id);
        return [];
    }
}