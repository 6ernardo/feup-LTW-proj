<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    $db = getDatabaseConnection();

    require_once(__DIR__ . '/../database/classes/user.class.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = User::getUserWithPassword($db, $username, $password);

    if($user){
        $session->setID($user->id);
        $session->setUsername($user->username);
        $session->setRole($user->role);
        $session->setEmail($user->email);
        $session->addMessage('success', 'Login successful!');
    }
    else {
        $session->addMessage('error', 'No user with this username or password exists.');
    }

    header('Location: ../pages');
?>