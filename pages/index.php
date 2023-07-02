<?php

declare(strict_types = 1);

require_once('../utils/session.php');
$session = new Session();

require_once('../database/connection.php');
$db = getDataBaseConnection();

require_once('../templates/common.tpl.php');
require_once('../templates/ticket.tpl.php');

require_once('../database/classes/ticket.class.php');

drawHeader($session);
if($session->isLoggedIn()){
    drawTickets(Ticket::getUserTickets($db, $session->getID()));
    drawButton('Submit new Ticket', '../pages/ticketsubmission.php');
    if($session->getRole() < 3 ){
        $tickets = Ticket::getAgentTickets($db, $session->getID());
        drawAgentTickets($tickets);
    }
} 
drawFooter();

?>