<?php

declare(strict_types = 1);

require_once('../utils/session.php');
$session = new Session();

require_once('../database/connection.php');
$db = getDataBaseConnection();

require_once('../templates/common.tpl.php');
require_once('../templates/ticket.tpl.php');

require_once('../database/classes/ticket.class.php');
require_once('../database/classes/inquiry.class.php');
require_once('../database/classes/department.class.php');
require_once('../database/classes/user.class.php');
require_once('../database/classes/faq.class.php');
require_once('../database/classes/status.class.php');

$ticket = Ticket::getTicket($db, intval($_GET['id']));
$inquiries = Inquiry::getTicketInquiries($db, intval($_GET['id']));
$departments = Department::getDepartments($db);
$agents = User::getAgents($db);
$faqs = FAQ::getAllFAQ($db);
$statuses = Status::getAllStatus($db);


drawHeader($session);
drawTicketInfo($ticket);
drawTicketInquirySection($ticket, $inquiries);

if($session->getRole() < 3){
    drawAgentTicketTools($ticket, $departments, $agents, $faqs, $statuses);
}

drawFooter();

?>