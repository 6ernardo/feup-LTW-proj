<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    $db = getDatabaseConnection();

    $agent = $_POST['agent'];
    $ticket = $_GET['id'];

    $stmt = $db->prepare('UPDATE tickets SET assignee_id = ? WHERE id = ?');
    $stmt->execute(array($agent, $ticket));

    $session->addMessage('success', 'Agent assigned with success!');

    header("Location: ../pages/ticket.php?id=$ticket");

?>