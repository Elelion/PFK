<?php
require_once 'lib/RedirectNotSupportBrowser.php';
require_once 'lib/DbHelperPDO.php';

date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();
$dbHelperPDO = new DbHelperPDO;

// **

if ((empty($_GET['idServices'])) || (!is_numeric($_GET['idServices']))) {
  header('Location: ./404.php');
} else {
  if (!$dbHelperPDO->getLastError()) {
    $id = htmlspecialchars(intval($_GET['idServices']));
    $dbHelperPDO->executeQuery("SELECT * FROM main_service WHERE id = '$id'");
  }

  $queryResult = $dbHelperPDO->getQueryResult();

  foreach ($queryResult as $row) {
    $title = $row['typeService'];
    $desc = $row['descriptionService'];
  }
}

// **

$file = basename(__FILE__, '.php');
require './src/' . $file . '.html';

// TODO: don't close!