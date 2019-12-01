<?php
require_once 'lib/functions.php';
require_once 'lib/DbHelperPDO.php';

session_start();

date_default_timezone_set('Europe/Moscow');
$dbHelperPDO = new DbHelperPDO;

/**/

// TODO: make a password
// $psw = "test";
// $hash = password_hash($psw, PASSWORD_DEFAULT);
// echo $hash . '<br>';


$pictchaQuestion = $_SESSION['pictcha'];
$pictchaResultUser = $_POST['pictcha'];
$pictchaAnswer = $pictchaQuestion[0] + $pictchaQuestion[1];

unset($_SESSION['pictcha']);
unset($pictchaQuestion);

/**/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['loginBtn'])) {

    // NOTE: check entered captcha
    if ($pictchaResultUser == $pictchaAnswer) {
      $loginReceived = htmlspecialchars($_POST['login']);
      $passwordReceived = htmlspecialchars($_POST['password']);
      $loginFormDB = null;
      $passwordFormDB = null;

      /**/

      if (!$dbHelperPDO->getLastError()) {
        $dbHelperPDO->executeQuery("SELECT * FROM users WHERE
          login = '$loginReceived'");

        $queryEventsResult = $dbHelperPDO->getQueryResult();
      } else {
        echo $dbHelperPDO->getLastError();
      }

      $queryResult = $dbHelperPDO->getQueryResult();

      foreach ($queryResult as $row) {
        $loginFormDB = $row['login'];
        $passwordFormDB = $row['password'];
      }

      /**/

      // NOTE: check the entered login & password
      if ($loginReceived === $loginFormDB) {
        if (password_verify($passwordReceived, $passwordFormDB)) {
          $_SESSION['user'] = $loginFormDB;
          header('Location: ./admin.php');
        } else {
          header('Location: ./alert.php?id=authorizationPasswordError');
        }
      } else {
        header('Location: ./alert.php?id=authorizationLoginError');
      }
    } else {
      echo 'Пиктча введена не верно';
    }

  }
}
