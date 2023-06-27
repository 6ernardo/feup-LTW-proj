<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    $db = getDatabaseConnection();

    $user_id = $_GET['id'];
    $dept = $_POST['department'];

    //check if agent is already assigned to that department
    $stmt = $db->prepare('SELECT * FROM agent_departments WHERE agent_id = ? AND department_id = ?');
    $stmt->execute(array($user_id, $dept));

    $count = $stmt->fetchColumn();

    if($count == 0){
        $stmt = $db->prepare('INSERT INTO agent_departments VALUES (?, ?)');
        $stmt->execute(array($user_id, $dept));

        $session->addMessage('success', 'Agent assigned to department with success!');
    }
    else $session->addMessage('error', 'Agent is already assigned to that department!');

    

    header("Location: ../pages/usermanagement.php?id=$user_id");

?>