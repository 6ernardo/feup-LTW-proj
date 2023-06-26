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

    $stmt = $db->prepare('INSERT INTO tickets (subject, content, submitter_id, department_id, status_id) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute(array($subject, $content, $session->getID(), $department, 1));

    $session->addMessage('success', 'Ticket created with success!');

    header('Location: ../pages');
?>