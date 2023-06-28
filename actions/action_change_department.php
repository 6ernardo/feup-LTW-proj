<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    $db = getDatabaseConnection();

    $department = $_POST['department'];
    $ticket = $_GET['id'];

    $stmt = $db->prepare('UPDATE tickets SET department_id = ? WHERE id = ?');
    $stmt->execute(array($department, $ticket));

    $session->addMessage('success', 'Ticket department changed with success!');

    header("Location: ../pages/ticket.php?id=$ticket");
?>