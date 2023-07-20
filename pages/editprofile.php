<?php

declare(strict_types = 1);

require_once('../utils/session.php');
$session = new Session();

require_once('../templates/common.tpl.php');
require_once('../templates/profile.tpl.php');

drawHeader($session);
drawEditProfile($session);
drawButton('Back', '../pages');
drawFooter();

?>