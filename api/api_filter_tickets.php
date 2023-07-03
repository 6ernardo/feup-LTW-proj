<?php
    declare(strict_types = 1);

    require_once('../utils/session.php');
    $session = new Session();

    require_once('../database/connection.php');
    $db = getDataBaseConnection();

    require_once('../database/classes/ticket.class.php');

    $department = $_GET['department'];
    $status = $_GET['status'];

    $query = 'SELECT * FROM tickets t LEFT JOIN departments d ON t.department_id = d.id WHERE 1';

    $array = array();

    if (!empty($department)) {
        $query .= ' AND d.id = ?';
        $array[] = $department;
    }

    if (!empty($status)) {
        $query .= ' AND t.status_id = ?';
        $array[] = $status;
    }

    $stmt = $db->prepare($query);
    $stmt->execute($array);

    $tickets = array();

    while($ticket = $stmt->fetch()){
        $tickets[] = new Ticket($ticket['id'], $ticket['subject'], $ticket['content'], 
                                        $ticket['submitter_id'], $ticket['assignee_id'], 
                                        $ticket['department_id'], $ticket['status_id']);
    }

    echo json_encode($tickets);
?>