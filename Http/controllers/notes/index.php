<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$user = Session::getData('user');
$notes = [];

if ($user) {
    $userId = $user['userId'];
    $notes = $db->query('SELECT * FROM notes WHERE user_id = :userId', ['userId' => $userId])->get();
}

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);