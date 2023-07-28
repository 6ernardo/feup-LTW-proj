<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    $db = getDatabaseConnection();

    require_once(__DIR__ . '/../database/classes/user.class.php');

    $subject = $_POST['subject'];
    $content = $_POST['content'];
    $department = $_POST['department'] ?? "";
    $date = date('Y-m-d');

    $stmt = $db->prepare('INSERT INTO tickets (subject, content, created, submitter_id, department_id, status_id) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($subject, $content, $date, $session->getID(), $department, 1));

    $session->addMessage('success', 'Ticket created with success!');

    $ticket_id = $db->lastInsertId();

    header("Location: ../pages/ticket.php?id=$ticket_id");
?>