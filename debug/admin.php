<?php
require_once 'lib/RedirectNotSupportBrowser.php';
require_once 'lib/DbHelperPDO.php';
require_once 'lib/Pictcha.php';
require_once 'lib/UserSession.php';

session_start();

date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();
$dbHelperPDO = new DbHelperPDO;
$pictcha = new Pictcha;
$userSession = new UserSession;

/**/

sessionCheck();

$randomNumbers = $_SESSION['pictcha'] = [
    $pictcha->getRandomNumber(),
    $pictcha->getRandomNumber()
];

if ($userSession->getAccess() != 'admin') {
    header('Location: ./alert.php?id=DeniedAccess');
    die();
}

/**/

$file = basename(__FILE__, ".php");
require './src/' . $file . '.html';
