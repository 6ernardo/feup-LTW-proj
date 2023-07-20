<?php

declare(strict_types = 1);

require_once('../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
$db = getDatabaseConnection();

require_once('../templates/common.tpl.php');
require_once('../templates/admin.tpl.php');

require_once('../database/classes/user.class.php');
require_once('../database/classes/department.class.php');
require_once('../database/classes/role.class.php');

$user_id = intval($_GET['id']);
$user = User::getUser($db, $user_id);
$dept_assigned = Department::getAssignedDepartments($db, $user_id);
$roles = Role::getRoles($db);
$departments = Department::getDepartments($db);

drawHeader($session);
drawUserInfo($user, $dept_assigned, $roles, $departments);
drawButton('Back', '../pages/admindashboard.php');
drawFooter();

?>