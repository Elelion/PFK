<?php
require_once 'lib/Pictcha.php';
require_once 'lib/UserSession.php';

date_default_timezone_set('Europe/Moscow');
$pictcha = new Pictcha;
$userSession = new UserSession;

/**/

$randomNumbers = $_SESSION['pictcha'] = [
	$pictcha->getRandomNumber(),
	$pictcha->getRandomNumber()
];

/**/

$file = basename(__FILE__, ".php");
require './src/' . $file . '.html';
