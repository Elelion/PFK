<?php
require_once 'lib/classes.php';
date_default_timezone_set('Europe/Moscow');
$dbHelper = new DbHelper;

// **

if (empty($_GET['id'])) {
  header('Location: ./404.php');
} else {
  $id = $_GET['id'];

  if (!$dbHelper->getLastError()) {
    $idType = mysqli_real_escape_string($dbHelper->getConnect(), $id);
    $dbHelper->executeQuery("SELECT * FROM alert_errors WHERE errorType = '$idType'");
  }

  $queryResult = $dbHelper->getQueryResult();

  foreach ($queryResult as $row) {
    $title = $row['errorTitle'];
    $caption = $row['errorCaption'];
    $description = $row['errorDescription'];
  }

  // NOTE: delay of few seconds, to protect against spam bots
  switch ($id) {
    case 'pageOk':
      header('refresh: 3; url=http://proffurkom.ru');
      break;

    default:
      header('refresh: 20; url=http://proffurkom.ru');
      break;
  }
}

$file = basename(__FILE__, '.php');
require './src/' . $file . '.html';

// TODO: don't close!