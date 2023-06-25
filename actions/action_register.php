<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    $db = getDatabaseConnection();

    require_once(__DIR__ . '/../database/classes/user.class.php');

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];



    if(!User::usernameAvailable($db, $username)){
        $session->addMessage('error', 'Name already exists');
    }
    else if($password != $password_confirm){
        $session->addMessage('error', 'Passwords did not match.');
    }
    else {
        $stmt = $db->prepare('INSERT INTO users (username, email, password, role_id) VALUES (?, ?, ?, ?)');
        $stmt->execute(array($username, $email, password_hash($password, PASSWORD_DEFAULT), 1));

        $session->addMessage('success', 'New account created with success! Login to continue.');

        header('Location: ../pages');
    }
?>