<?php
require_once 'lib/RedirectNotSupportBrowser.php';
require_once 'lib/Pictcha.php';

date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();
$pictcha = new Pictcha;

/**/

$file = basename(__FILE__, '.php');
require './src/' . $file . '.html';
