<?php
declare(strict_types=1);

require_once 'lib/RedirectNotSupportBrowser.php';
require_once 'lib/DbHelperPDO.php';
require_once 'lib/Import.php';

date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();
$dbHelperPDO = new DbHelperPDO;
$import = new Import;

/**/

if ( (empty($_GET['idCommand']))
  || ($_SERVER['REQUEST_METHOD'] !== 'POST')
  || (!isset($_POST['registrationBtn']))
) {
  header('Location: ./404.php');
}

/**/

$idCommand = $_GET['idCommand'];
switch ($idCommand) {
	case 'import':
		if (isset($_POST['BtnImportFileToDB'])) {
			if ((!empty($_POST['importFile'])) && (!empty($_POST['exportDB']))) {
				try {
					$import->setFileName($_POST['importFile']);
					$import->setTableName($_POST['exportDB']);
					$import->beginEvent();
				} catch (Throwable $exception) {
					echo $exception->getMessage();
				}

				header('Location: ./admin.php');
			} else {
				echo 'Что то, как то не так передано...';
			}
		} else {
			echo 'Что нажато не так, как нужно...';
		}
	break;
}
