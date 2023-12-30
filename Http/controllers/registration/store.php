<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Validator;
use Http\Forms\RegisterForm;

$db = App::resolve(Database::class);

$email     = $_POST['email'];
$firstName = $_POST['firstName'];
$lastName  = $_POST['lastName'];
$password  = $_POST['password'];

$form = RegisterForm::validate($attributes = [
    'email'     => $email,
    'firstName' => $firstName,
    'lastName'  => $lastName,
    'password'  => $password
]);

$user = $db->query(
    'select * from users where email = :email', 
    ['email' => $email]
    )->find();

if ($user) {
    $form->error(
        'email', 'email is taken'
    )->throw();
} else {
    $user = $db->query('
        INSERT INTO users(
            email, 
            firstName, 
            lastName, 
            password
        ) 
        VALUES(
            :email, 
            :firstName, 
            :lastName, 
            :password
        )', 
        [
            'email' => $email,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]
    );

    (new Authenticator)->login(['email' => $email]);

    header('location: /notes');
    exit();
}
