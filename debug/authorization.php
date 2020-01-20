<?php
require_once 'lib/functions.php';
require_once 'lib/DbHelperPDO.php';
require_once 'lib/UserSession.php';

session_start();

date_default_timezone_set('Europe/Moscow');
$dbHelperPDO = new DbHelperPDO;
$userSession = new UserSession;

/**/

// NOTE: protection against user access to this page
if ( ($_SERVER['REQUEST_METHOD'] !== 'POST')){
    header('Location: ./404.php');
    die();
}

// NOTE: click on the exit button
if (isset($_POST['logoutBtn'])) {
  unset($_SESSION['user']);
  session_destroy();
  header('Location: ./');
  exit();
}

/**/

// NOTE: check entered captcha
$pictchaQuestion = $_SESSION['pictcha'];
$pictchaResultUser = $_POST['pictcha'];
$pictchaAnswer = $pictchaQuestion[0] + $pictchaQuestion[1];
unset($_SESSION['pictcha']);
unset($pictchaQuestion);

if ($pictchaResultUser != $pictchaAnswer) {
    header('Location: ./alert.php?id=authorizationPictchaError');
    die();
}

/**/

// NOTE: check the entered login & password
$loginReceived = htmlspecialchars($_POST['login']);
$passwordReceived = htmlspecialchars($_POST['password']);
$loginFormDB = null;
$passwordFormDB = null;

if (!$dbHelperPDO->getLastError()) {
    $dbHelperPDO->executeQuery("SELECT * FROM `users`
        JOIN users_access ON users.access_id = users_access.id
        WHERE login = '$loginReceived'");
} else {
    echo $dbHelperPDO->getLastError();
}

$queryResult = $dbHelperPDO->getQueryResult();
foreach ($queryResult as $row) {
    $loginFormDB = $row['login'];
    $passwordFormDB = $row['password'];
    $access = $row['access'];
    $active = $row['active'];
}

if ($loginReceived !== $loginFormDB) {
    header('Location: ./alert.php?id=authorizationLoginError');
    die();
}

if (!password_verify($passwordReceived, $passwordFormDB)) {
    header('Location: ./alert.php?id=authorizationPasswordError');
    die();
}

/**/

// NOTE: check the account for activation status
if ($active != true) {
    header('Location: ./alert.php?id=authorizationActiveError');
    die();
}

/**/

// NOTE: login user after all checks
$_SESSION['user'] = [
  'login' => $loginFormDB,
  'access' => $access
];
header('Location: ./');
