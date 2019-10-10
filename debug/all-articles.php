<?php
require_once 'lib/RedirectNotSupportBrowser.php';
require_once 'lib/DbHelperPDO.php';

date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();
$dbHelperPDO = new DbHelperPDO;

// **

if (!$dbHelperPDO->getLastError()) {
  $dbHelperPDO->executeQuery('SELECT * FROM `articles` ORDER BY id DESC');
}

$queryResult = $dbHelperPDO->getQueryResult();

foreach ($queryResult as $row) {
  $title = $row['title'];
  $time = $row['time_create'];
  $date = $row['date_create'];
  $desc = $row['fullDescription'];
}

// **

$file = basename(__FILE__, ".php");
require './src/' . $file . '.html';

// TODO: don't close!