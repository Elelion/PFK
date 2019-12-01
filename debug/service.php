<?php
require_once 'lib/functions.php';
require_once 'lib/Pictcha.php';

date_default_timezone_set('Europe/Moscow');
$pictcha = new Pictcha;

/**/

$file = basename(__FILE__, ".php");
require './src/' . $file . '.html';
