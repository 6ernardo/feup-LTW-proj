<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    $db = getDatabaseConnection();

    require_once('../database/classes/ticket.class.php');

    $status = $_POST['status'];
    $ticket_id = $_GET['id'];

    $ticket = Ticket::getTicket($db, intval($ticket_id));

    $stmt = $db->prepare('UPDATE tickets SET status_id = ? WHERE id = ?');
    $stmt->execute(array($status, $ticket_id));

    // Add change to history
    $stmt = $db->prepare('INSERT INTO ticket_changes (ticket_id, user_id, changed_field, old_version, new_version)
                         VALUES (?, ?, ?, ?, ?)');
    $stmt->execute(array($ticket_id, $session->getID(), 'Changed Status', $ticket->status_id, $status));

    $session->addMessage('success', 'Ticket status updated!');

    header("Location: ../pages/ticket.php?id=$ticket_id");
?>