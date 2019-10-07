<?php
require_once 'lib/classes.php';
date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();
$dbHelper = new DbHelper;

// **

if ((empty($_GET['idServices'])) || (!is_numeric($_GET['idServices']))) {
  header('Location: ./404.php');
} else {
  if (!$dbHelper->getLastError()) {
    $id = mysqli_real_escape_string($dbHelper->getConnect(), $_GET['idServices']);
    $dbHelper->executeQuery("SELECT * FROM main_service WHERE id = '$id'");
  }

  $queryResult = $dbHelper->getQueryResult();

  foreach ($queryResult as $row) {
    $title = $row['typeService'];
    $desc = $row['descriptionService'];
  }
}

// **

$file = basename(__FILE__, '.php');
require './src/' . $file . '.html';

// TODO: don't close!