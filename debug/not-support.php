<?php
require_once 'lib/Pictcha.php';
require_once 'lib/UserSession.php';

date_default_timezone_set('Europe/Moscow');

/**/

$file = basename(__FILE__, '.php');
require './src/' . $file . '.html';
