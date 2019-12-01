<?php
require_once 'lib/RedirectNotSupportBrowser.php';
require_once 'lib/DbHelperPDO.php';
require_once 'lib/Pictcha.php';

session_start();

date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();
$dbHelperPDO = new DbHelperPDO;
$pictcha = new Pictcha;

/**/

$randomNumbers = $_SESSION['pictcha'] = [
  $pictcha->getRandomNumber(),
  $pictcha->getRandomNumber()
];

/**/

if (!$dbHelperPDO->getLastError()) {
  // NOTE: to display events
  $dbHelperPDO->executeQuery('SELECT * FROM `events` WHERE active = 1 LIMIT 3');
  $queryEventsResult = $dbHelperPDO->getQueryResult();

  // NOTE: to display articles
  $dbHelperPDO->executeQuery('SELECT * FROM `articles` ORDER BY id DESC LIMIT 6');
  $queryArticleResult = $dbHelperPDO->getQueryResult();
} else {
  echo $dbHelperPDO->getLastError();
}

/**/

$file = basename(__FILE__, ".php");
require './src/' . $file . '.html';
