<?php
require_once 'lib/RedirectNotSupportBrowser.php';
require_once 'lib/DbHelper.php';

date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();
$dbHelper = new DbHelper;

// **

if ((empty($_GET['idArticles'])) || (!is_numeric($_GET['idArticles']))) {
  header('Location: ./404.php');
} else {
  if (!$dbHelper->getLastError()) {
    $id = mysqli_real_escape_string($dbHelper->getConnect(), $_GET['idArticles']);
    $dbHelper->executeQuery("SELECT * FROM articles WHERE id = '$id'");
  }

  $queryResult = $dbHelper->getQueryResult();

  foreach ($queryResult as $row) {
    $title = $row['title'];
    $time = $row['time_create'];
    $date = $row['date_create'];
    $desc = $row['fullDescription'];
  }
}

// **

$file = basename(__FILE__, '.php');
require './src/' . $file . '.html';

// TODO: don't close!