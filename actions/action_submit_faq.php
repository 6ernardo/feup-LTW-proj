<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    $db = getDatabaseConnection();

    $question = $_POST['question'];
    $answer = $_POST['answer'];

    $stmt = $db->prepare('INSERT INTO faq (question, answer) VALUES (?, ?)');
    $stmt->execute(array($question, $answer));

    $session->addMessage('success', 'Added to FAQ with success!');

    header('Location: ../pages/faq.php');

?>