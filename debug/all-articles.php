<?php
require_once 'lib/classes.php';
date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();
$dbHelper = new DbHelper;

// **

if (!$dbHelper->getLastError()) {
  $dbHelper->executeQuery('SELECT * FROM `articles` ORDER BY id DESC');
}

$queryResult = $dbHelper->getQueryResult();

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