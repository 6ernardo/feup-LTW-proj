<?php

declare(strict_types = 1);

require_once('../utils/session.php');
$session = new Session();

require_once('../database/connection.php');
$db = getDataBaseConnection();

require_once('../templates/common.tpl.php');
require_once('../templates/faq.tpl.php');

require_once('../database/classes/faq.class.php');

$faqs = FAQ::getAllFAQ($db);

drawHeader($session);
drawFAQ($faqs);
if($session->isLoggedIn() && $session->getRole() < 3) drawSubmitFAQ();
drawButton('Back', '../pages');
drawFooter();

?>