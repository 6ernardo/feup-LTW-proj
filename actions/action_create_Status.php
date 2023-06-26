<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    $db = getDatabaseConnection();

    require_once(__DIR__ . '/../database/classes/status.class.php');

    $name = $_POST['Status_name'];

    if(Status::statusNameAvailable($db, $name)){
        $stmt = $db->prepare('INSERT INTO status (name) VALUES (?)');
        $stmt->execute(array($name));

        $session->addMessage('success', 'Status created with success!');
    }
    else $session->addMessage('error', 'Status with same name already exists.');

    header('Location: ../pages/admindashboard.php')
?>