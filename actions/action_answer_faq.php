<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    $db = getDatabaseConnection();

    $faq_id = $_POST['faq'];
    $ticket = $_GET['id'];

    $stmt = $db->prepare('SELECT * FROM faq WHERE id = ?');
    $stmt->execute(array($faq_id));

    $faq = $stmt->fetch();
    $question = $faq['question'];
    $answer = $faq['answer'];
    $date = date('Y-m-d H:i');

    $content = "Your problem can be solved with the following entry in our FAQ: " . $question . " " . $answer;

    $stmt = $db->prepare('INSERT INTO ticket_inquiries (ticket_id, user_id, content, date) VALUES (?, ?, ?, ?)');
    $stmt->execute(array($ticket, $session->getID(), $content, $date));

    $session->addMessage('success', 'Responded to inquiry with FAQ.');

    header("Location: ../pages/ticket.php?id=$ticket");
?>