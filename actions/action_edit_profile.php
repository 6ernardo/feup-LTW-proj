<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    $db = getDatabaseConnection();

    require_once(__DIR__ . '/../database/classes/user.class.php');

    $username = $_POST['username'] ?? "";
    $email = $_POST['email'] ?? "";
    $password = $_POST['password'] ?? "";
    $password_confirm = $_POST['password_confirm'] ?? "";

    if(!empty($username) && User::usernameAvailable($db, $username)){
        $stmt = $db->prepare('UPDATE users SET username = ? WHERE id = ?');
        $stmt->execute(array($username, $session->getID()));

        $session->setUsername($username);
    }

    if(!empty($email)){
        $stmt = $db->prepare('UPDATE users SET email = ? WHERE id = ?');
        $stmt->execute(array($email, $session->getID()));

        $session->setEmail($email);
    }

    if(!empty($password)){
        if($password === $password_confirm){
            $stmt = $db->prepare('UPDATE users SET password = ? WHERE id = ?');
            $stmt->execute(array(password_hash($password, PASSWORD_DEFAULT), $session->getID()));
        }
        else echo 'Passwords did not match';
    }
    
    //header('Location: ../pages');

?>