<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    $db = getDatabaseConnection();

    $ticket = $_GET['id'];
    $user = $session->getID();
    $content = $_POST['inquiry'];

    $stmt = $db->prepare('INSERT INTO ticket_inquiries (ticket_id, user_id, content) VALUES (?, ?, ?)');
    $stmt->execute(array($ticket, $user, $content));

    $session->addMessage('success', 'Inquiry message submited!');

    header("Location: ../pages/ticket.php?id=$ticket")
?>