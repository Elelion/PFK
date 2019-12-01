<?php
require_once 'lib/RedirectNotSupportBrowser.php';
require_once 'lib/DbHelperPDO.php';
require_once 'lib/Pictcha.php';

date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();
$dbHelperPDO = new DbHelperPDO;
$pictcha = new Pictcha;

/**/

if (!$dbHelperPDO->getLastError()) {
  $dbHelperPDO->executeQuery('SELECT * FROM `catalog_1` ORDER BY id');
} else {
  echo $dbHelperPDO->getLastError();
}

$queryCatalogResult = $dbHelperPDO->getQueryResult();

/**/

$file = basename(__FILE__, ".php");
require './src/' . $file . '.html';
