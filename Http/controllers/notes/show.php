<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$user = Session::getData('user');

$note = $db->query('
    SELECT * FROM notes 
    WHERE id = :id', 
    [
        'id' => $_GET['id']
    ]
)->findOrFail();

authorize($note['user_id'] === $user['userId']);

view("notes/show.view.php", [
    'heading' => 'Note: ' . $note['title'],
    'note' => $note
]);