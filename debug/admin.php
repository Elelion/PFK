<?php
require_once 'lib/RedirectNotSupportBrowser.php';
require_once 'lib/DbHelperPDO.php';
require_once 'lib/Pictcha.php';

session_start();

date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();
$dbHelperPDO = new DbHelperPDO;
$pictcha = new Pictcha;

/**/


if (!isset($_SESSION['user'])) {
  unset($_SESSION['user']);
  session_destroy();

  header('Location: ./');
  exit();
}

// TODO: если в БД в доступе стоит админ, то подключаем верстку админа, если нет то юзера

/**/

$file = basename(__FILE__, ".php");
require './src/' . $file . '.html';
