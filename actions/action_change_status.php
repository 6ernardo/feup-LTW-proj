<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    $db = getDatabaseConnection();

    $status = $_POST['status'];
    $ticket = $_GET['id'];

    $stmt = $db->prepare('UPDATE tickets SET status_id = ? WHERE id = ?');
    $stmt->execute(array($status, $ticket));

    $session->addMessage('success', 'Ticket status updated!');

    header("Location: ../pages/ticket.php?id=$ticket");
?>