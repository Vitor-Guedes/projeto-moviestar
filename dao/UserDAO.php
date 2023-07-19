<?php

include_once(MODELS_DIR . '/User.php');

class UserDAO implements UserDAOInterface
{
    protected $connection;

    protected $url;

    protected $message;

    public function __construct($connection, $url)
    {
        $this->connection = $connection;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildUser(array $data = [])
    {
        $user = new User();
        $user->id = $data['id'];
        $user->name = $data['name'];
        $user->lastname = $data['lastname'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->image = $data['image'];
        $user->bio = $data['bio'];
        $user->token = $data['token'];

        return $user;
    }

    public function create(User $user, $authUser = false)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO users
                (name, lastname, email, password, token) 
            VALUES 
                (:name, :lastname, :email, :password, :token)"
            );
    
            $stmt->bindParam(':name', $user->name);
            $stmt->bindParam(':lastname', $user->lastname);
            $stmt->bindParam(':email', $user->email);
            $stmt->bindParam(':password', $user->password);
            $stmt->bindParam(':token', $user->token);
    
            $stmt->execute();
    
            if ($authUser) {
                $this->setTokenToSession($user->token);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update(User $user, $redirect = true)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE users SET 
                name = :name, 
                lastname = :lastname, 
                email = :email, 
                image = :image, 
                bio = :bio, 
                token = :token
            WHERE id = :id");
            
            $stmt->bindParam(':name', $user->name);
            $stmt->bindParam(':lastname', $user->lastname);
            $stmt->bindParam(':email', $user->email);
            $stmt->bindParam(':image', $user->image);
            $stmt->bindParam(':bio', $user->bio);
            $stmt->bindParam(':token', $user->token);
            $stmt->bindParam(':id', $user->id);

            $stmt->execute();

            if ($redirect) {
                $this->message->setMessage(
                    'Dados atualizados com sucess!',
                    'success',
                    '/edit/profile'
                );
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function verifyToken($protected = false)
    {
        if (!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];
            $user = $this->findByToken($token);

            if ($user) {
                return $user;
            }
        }
        if ($protected) {
            $this->message->setMessage(
                'Faça a autenticação para acessar essa página!',
                'error',
                '/'
            );
        }
        return false;
    }

    public function setTokenToSession($token, $redirect = true)
    {
        $_SESSION['token'] = $token;
        if ($redirect) {
            $this->message->setMessage(
                'Seja Bem-Vindo!',
                'success',
                '/edit/profile'
            );
        }
    }

    public function authenticateUser($email, $password)
    {
        try {
            $user = $this->findByEmail($email);
            if ($user && password_verify($password, $user->password)) {
                $user->token = $user->generateToken();
                $this->setTokenToSession($user->token, false);
                $this->update($user, false);
    
                return true;
            }
            $this->message->setMessage(
                'Usuário ou senha inválidos',
                'error',
                'back'
            );
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function findByToken($token)
    {
        if (empty($token)) {
            return false;
        }

        $query = "SELECT * FROM users WHERE token = :token";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch();
            return $this->buildUser($data);
        }
        return false;
    }

    public function findByEmail($email)
    {
        if (empty($email)) {
            return false;
        }

        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch();
            return $this->buildUser($data);
        }
        return false;
    }

    public function findById($id)
    {

    }

    public function changePassword(User $user)
    {
        
        try {
            $stmt = $this->connection->prepare("UPDATE users SET 
                password = :password 
            WHERE id = :id");
            
            $stmt->bindParam(':password', $user->password);
            $stmt->bindParam(':id', $user->id);

            $stmt->execute();

            $this->message->setMessage(
                'Senha alterada com sucess!',
                'success',
                '/edit/profile'
            );
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function destroyToken(User $user)
    {
        $_SESSION['token'] = '';
        $this->message->setMessage(
            'Você fez o logout com sucesso!',
            'success',
            '/'
        );
    }
}