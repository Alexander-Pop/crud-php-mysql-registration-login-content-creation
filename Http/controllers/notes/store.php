<?php

use Core\App;
use Core\Validator;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$user = Session::getData('user');
$errors = [];

if (! Validator::string($_POST['title'], 1, 100)) {
    $errors['title'] = 'A title of no more than 100 characters is required.';
}

if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';
}

if (! empty($errors)) {
    return view("notes/create.view.php", [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}

$db->query('INSERT INTO notes(title, body, user_id) VALUES(:title, :body, :user_id)', [
    'body' => $_POST['body'],
    'title' => $_POST['title'],
    'user_id' => $user['userId']
]);

header('location: /notes');
die();
