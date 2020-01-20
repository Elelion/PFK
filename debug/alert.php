<?php
require_once 'lib/DbHelperPDO.php';
require_once 'lib/Pictcha.php';
require_once 'lib/UserSession.php';

date_default_timezone_set('Europe/Moscow');
$dbHelperPDO = new DbHelperPDO;
$pictcha = new Pictcha;
$userSession = new UserSession;

/**/

$randomNumbers = $_SESSION['pictcha'] = [
    $pictcha->getRandomNumber(),
    $pictcha->getRandomNumber()
];

/**/

if (empty($_GET['id'])) {
	  header('Location: ./404.php');
	  die();
}

/**/

$id = htmlspecialchars($_GET['id']);
if (!$dbHelperPDO->getLastError()) {
    $dbHelperPDO->executeQuery("SELECT * FROM alert_errors WHERE
        error_type = '$id'");
} else {
    echo $dbHelperPDO->getLastError();
}

$queryResult = $dbHelperPDO->getQueryResult();
foreach ($queryResult as $row) {
    $title = $row['error_title'];
    $caption = $row['error_caption'];
    $description = $row['error_description'];
}

// NOTE: delay of few seconds, to protect against spam bots
switch ($id) {
    case 'pageOk':
    case 'registrationOk':
        header('refresh: 3; url=http://proffurkom.ru');
        break;

    // NOTE: error
    default:
        header('refresh: 20; url=http://proffurkom.ru');
        break;
}

/**/

$file = basename(__FILE__, '.php');
require './src/' . $file . '.html';
