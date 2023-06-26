<?php

declare(strict_types = 1);

require_once('../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
$db = getDatabaseConnection();

require_once('../templates/common.tpl.php');
require_once('../templates/ticket.tpl.php');

require_once('../database/classes/department.class.php');

drawHeader($session);
drawTicketSubmit(Department::getDepartments($db));
drawFooter();

?>