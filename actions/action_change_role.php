<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    $db = getDatabaseConnection();

    $user_id = $_GET['id'];
    $role = $_POST['role'];

    $stmt = $db->prepare('UPDATE users SET role_id = ? WHERE id = ?');
    $stmt->execute(array($role, $user_id));

    $session->addMessage('success', 'Role changed with success!');

    header("Location: ../pages/usermanagement.php?id=$user_id");
?>