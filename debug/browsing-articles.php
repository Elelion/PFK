<?php
require_once 'lib/RedirectNotSupportBrowser.php';
require_once 'lib/DbHelperPDO.php';
require_once 'lib/Pictcha.php';

date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();
$dbHelperPDO = new DbHelperPDO;
$pictcha = new Pictcha;

/**/

if ((empty($_GET['idArticles'])) || (!is_numeric($_GET['idArticles']))) {
  header('Location: ./404.php');
} else {
  if (!$dbHelperPDO->getLastError()) {
    $id = htmlspecialchars(intval($_GET['idArticles']));
    $dbHelperPDO->executeQuery("SELECT * FROM articles WHERE id = '$id'");
  } else {
    echo $dbHelperPDO->getLastError();
  }

  $queryResult = $dbHelperPDO->getQueryResult();

  foreach ($queryResult as $row) {
    $title = $row['title'];
    $time = $row['time_create'];
    $date = $row['date_create'];
    $desc = $row['fullDescription'];
  }
}

/**/

$file = basename(__FILE__, '.php');
require './src/' . $file . '.html';
