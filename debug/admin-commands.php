<?php
require_once 'lib/RedirectNotSupportBrowser.php';
require_once 'lib/DbHelperPDO.php';
require_once 'lib/Import.php';

date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();
$dbHelperPDO = new DbHelperPDO;
$import = new Import;

// **

$idCommand = $_GET['idCommand'];

switch ($idCommand) {
  case 'import':
    if (isset($_POST['importFileToDB'])) {
      if ( (!empty($_POST['importFile'])) && (!empty($_POST['exportDB'])) ) {
        $import->setFileName($_POST['importFile']);
        $import->setTableName($_POST['exportDB']);
        $import->beginEvent();

        header('Location: ./admin.php');
      } else {
        echo 'Что то, как то не так передано...';
      }
    } else {
      echo 'Что нажато не так, как нужно...';
    }
    break;
}