<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    $db = getDatabaseConnection();

    require_once('../database/classes/ticket.class.php');

    $department = $_POST['department'];
    $ticket_id = $_GET['id'];
    $date = date('Y-m-d H:i');
    $date1 = date('Y-m-d');

    $ticket = Ticket::getTicket($db, intval($ticket_id));

    $stmt = $db->prepare('UPDATE tickets SET department_id = ? WHERE id = ?');
    $stmt->execute(array($department, $ticket_id));

    // Add change to history
    $stmt = $db->prepare('INSERT INTO ticket_changes (ticket_id, user_id, changed_field, old_version, new_version, date)
                         VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($ticket_id, $session->getID(), 'Assigned Department', $ticket->department_id, $department, $date));

    // Set UPDATED date
    $stmt = $db->prepare(('UPDATE tickets SET updated = ? WHERE id = ?'));
    $stmt->execute(array($date1, $ticket_id));

    $session->addMessage('success', 'Ticket department changed with success!');

    header("Location: ../pages/ticket.php?id=$ticket_id");
?>