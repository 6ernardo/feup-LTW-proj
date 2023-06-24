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
        header('Location: ../pages');
    }
    else {
        /* Error message */
        echo 'No user with this username or password exists';
    }
?>