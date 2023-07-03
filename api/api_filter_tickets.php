<?php
    declare(strict_types = 1);

    require_once('../utils/session.php');
    $session = new Session();

    require_once('../database/connection.php');
    $db = getDataBaseConnection();

    require_once('../database/classes/ticket.class.php');

    $department = intval($_GET['department']);
    $status = intval($_GET['status']);

    $tickets = Ticket::filterTickets($db, $department, $status);

    echo json_encode($tickets);
?>