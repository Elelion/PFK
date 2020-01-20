<?php
require_once 'lib/RedirectNotSupportBrowser.php';
require_once 'lib/DbHelperPDO.php';
require_once 'lib/Pictcha.php';
require_once 'lib/UserSession.php';

date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();
$dbHelperPDO = new DbHelperPDO;
$pictcha = new Pictcha;
$userSession = new UserSession;

/**/

$randomNumbers = $_SESSION['pictcha'] = [
	$pictcha->getRandomNumber(),
	$pictcha->getRandomNumber()
];

if (!$dbHelperPDO->getLastError()) {
	$dbHelperPDO->executeQuery('SELECT * FROM `articles` ORDER BY id DESC');
} else {
	echo $dbHelperPDO->getLastError();
}

$queryArticleResult = $dbHelperPDO->getQueryResult();

foreach ($queryArticleResult as $row) {
	$title = $row['title'];
	$time = $row['time_create'];
	$date = $row['date_create'];
	$desc = $row['full_description'];
}

/**/

$file = basename(__FILE__, ".php");
require './src/' . $file . '.html';
