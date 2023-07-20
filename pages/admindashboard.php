<?php

declare(strict_types = 1);

require_once('../utils/session.php');
$session = new Session();

require_once('../database/connection.php');
$db = getDataBaseConnection();

require_once('../templates/common.tpl.php');
require_once('../templates/admin.tpl.php');

require_once('../database/classes/user.class.php');
require_once('../database/classes/department.class.php');
require_once('../database/classes/status.class.php');

drawHeader($session);
drawUsers(User::getAllUsers($db));
drawElementSection(Department::getDepartments($db), 'Department');
drawElementSection(Status::getAllStatus($db), 'Status');
drawButton('Back', '../pages');
drawFooter();

?>