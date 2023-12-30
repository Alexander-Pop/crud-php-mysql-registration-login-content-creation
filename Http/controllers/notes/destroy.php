<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$user = Session::getData('user');

$currentUserId = $user['userId'];

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$db->query('DELETE FROM notes WHERE id = :id', [
    'id' => $_POST['id']
]);

header('location: /notes');
exit();
