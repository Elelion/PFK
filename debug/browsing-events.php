<?php
require_once 'lib/RedirectNotSupportBrowser.php';
require_once 'lib/DbHelperPDO.php';
require_once 'lib/Pictcha.php';

date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();
$dbHelperPDO = new DbHelperPDO;
$pictcha = new Pictcha;

/**/

if ((empty($_GET['idEvents'])) || (!is_numeric($_GET['idEvents']))) {
  header('Location: ./404.php');
} else {
  if (!$dbHelperPDO->getLastError()) {
    $id = htmlspecialchars(intval($_GET['idEvents']));
    $dbHelperPDO->executeQuery("SELECT * FROM events WHERE id = '$id'");
  } else {
    echo $dbHelperPDO->getLastError();
  }

  $queryResult = $dbHelperPDO->getQueryResult();

  foreach ($queryResult as $row) {
    $title = $row['title'];
    $miniDesc = $row['miniDescription'];
    $fullDesc = $row['fullDescription'];
    $redirect = $row['redirect'];
  }

  /**
   * NOTE:
   * to redirect to a directory to which the necessary SQL queries
   * will already be applied
   */
  if ($redirect !== '') {
    // TODO: make after product catalog
    // echo $redirect;
  }
}

/**/

$file = basename(__FILE__, '.php');
require './src/' . $file . '.html';
