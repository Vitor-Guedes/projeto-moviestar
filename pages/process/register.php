<?php
    $message = new Message(BASE_URL);

    $userDao = new UserDAO($connection, BASE_URL);

    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email= $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    $_message = 'Por favor preencha todos os campos.';
    $_type = 'error';
    $_redirect = 'back';

    if ($name && $lastname && $email && ($password && $confirmpassword)) {

        if ($password !== $confirmpassword) {
            $_message = 'A senha e a confirmação precisam ser iguais.';
        }

        $userExists = $userDao->findByEmail($email);
        if ($userExists !== false) {
            $_message = 'Usuário já cadastrado, tente outro email.';
        }

        if ($userExists === false) {
            $user = new User();

            $user->name = $name;
            $user->lastname = $lastname;
            $user->email = $email;
            $user->password = $user->generatePassword($password);
            $user->token = $user->generateToken();

            return $userDao->create($user, true);
        }
    }

    $message->setMessage(
        $_message,
        $_type,
        $_redirect
    );