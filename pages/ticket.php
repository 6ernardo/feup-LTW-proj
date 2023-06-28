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

$ticket = Ticket::getTicket($db, intval($_GET['id']));
$inquiries = Inquiry::getTicketInquiries($db, intval($_GET['id']));

drawHeader($session);
drawTicketInfo($ticket);
drawTicketInquirySection($ticket, $inquiries);
drawFooter();

?>