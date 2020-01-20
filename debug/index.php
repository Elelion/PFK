<?php
require_once 'lib/RedirectNotSupportBrowser.php';
require_once 'lib/DbHelperPDO.php';
require_once 'lib/Pictcha.php';
require_once 'lib/UserSession.php';

date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();
$dbHelperPDO = new DbHelperPDO;
$pictcha = new Pictcha;
$userSession = new UserSession;

/**/

$randomNumbers = $_SESSION['pictcha'] = [
    $pictcha->getRandomNumber(),
    $pictcha->getRandomNumber()
];

/**/

if (!$dbHelperPDO->getLastError()) {
    // NOTE: to display events
    $dbHelperPDO->executeQuery('SELECT * FROM `events`
        WHERE active = 1 LIMIT 3');
    $queryEventsResult = $dbHelperPDO->getQueryResult();

    // NOTE: to display articles
    $dbHelperPDO->executeQuery('SELECT * FROM `articles`
        ORDER BY id DESC LIMIT 6');
    $queryArticleResult = $dbHelperPDO->getQueryResult();

    // NOTE: for admin/user panel
    $dbHelperPDO->executeQuery('SELECT * FROM `users`');
    $users = $dbHelperPDO->getQueryResult();

    // NOTE: for admin/user panel
    $dbHelperPDO->executeQuery('SELECT * FROM `users_access`');
    $access = $dbHelperPDO->getQueryResult();

    // bingo!
    $dbHelperPDO->executeQuery('SELECT * FROM `users`
        JOIN users_access ON users.access_id = users_access.id');
    $usr = $dbHelperPDO->getQueryResult();

    $ch = '333333@ya.ru';
    foreach ($usr as $row) {
        echo $row['login'] . '<br>';
        if ($ch === $row['login']) {
//            echo 'bingo';
//            die();
        }
    }
    } else {
        echo $dbHelperPDO->getLastError();
    }

/**/

// $access = 'user';
// TODO: доделать регистрацию
// session_destroy();
// $psw = "test";
// $hash = password_hash($psw, PASSWORD_DEFAULT);
// echo $hash . '<br>';

/**/

$file = basename(__FILE__, ".php");
require './src/' . $file . '.html';
