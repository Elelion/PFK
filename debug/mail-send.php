<?php
require_once 'lib/classes.php';
require_once 'lib/functions.php';
date_default_timezone_set('Europe/Moscow');

// **

$idType = $_GET['idType'];

if (empty($idType)) {
  header('Location: ./404.php');
} else {
  switch ($idType) {
    case 'contact':
      validation('basic');
      break;

    case 'service':
      validation('advanced');
      break;

    default:
      header('Location: ./alert.php?id=default');
      break;
  }
}
?>