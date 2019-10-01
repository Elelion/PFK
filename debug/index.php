<?php
require_once 'lib/functions.php';
date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();
$dbHelper = new DbHelper;

// **

if (!$dbHelper->getLastError()) {
  $dbHelper->executeQuery('SELECT * FROM `articles` ORDER BY id DESC LIMIT 6');
}

$queryResult = $dbHelper->getQueryResult();

// **

$file = basename(__FILE__, ".php");
require './src/' . $file . '.html';

// TODO: don't close!