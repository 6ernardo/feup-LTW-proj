<?php

declare(strict_types = 1);

require_once('../utils/session.php');
$session = new Session();

require_once('../database/connection.php');
$db = getDataBaseConnection();

require_once('../templates/common.tpl.php');
require_once('../templates/ticket.tpl.php');

require_once('../database/classes/ticket.class.php');
require_once('../database/classes/status.class.php');
require_once('../database/classes/department.class.php');

drawHeader($session);
if($session->isLoggedIn()){
    drawTickets($db, Ticket::getUserTickets($db, $session->getID()));
    drawButton('Submit new Ticket', '../pages/ticketsubmission.php');
    if($session->getRole() < 3 ){
        $tickets = Ticket::getAgentTickets($db, $session->getID());
        $departments = Department::getDepartments($db);
        $statuses = Status::getAllStatus($db);
        drawAgentTickets($db, $tickets, $departments, $statuses);
    }
    if($session->getRole() == 1 ){
        drawButton('Admin Dashboard', '../pages/admindashboard.php');
    }
} 
drawFooter();

?>