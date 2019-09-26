<?php
require_once 'lib/functions.php';
date_default_timezone_set('Europe/Moscow');

// **

$link = connectDB();

// **

$idContact = $_GET['idContact'];

if (empty($_GET['idContact'])) {
  Error404();
} else {
  $idType = mysqli_real_escape_string($link, $_GET['idContact']);
  $sqlQuery = "SELECT * FROM alert_errors WHERE errorType = '$idType'";

  $result = mysqli_query($link, $sqlQuery);
  $resultList = mysqli_fetch_all($result, MYSQLI_ASSOC);

  foreach ($resultList as $row) {
    $title = $row['errorTitle'];
    $caption = $row['errorCaption'];
    $description = $row['errorDescription'];
  }

  // NOTE: delay of few seconds, to protect against spam bots
  switch ($idContact) {
    case 'contactPageOk':
      header('refresh: 3; url=http://proffurkom.ru/contacts.php');
      break;

    case 'mailError': {
      header('refresh: 25; url=http://proffurkom.ru/contacts.php');
      break;
    }

    case 'phoneError': {
      header('refresh: 25; url=http://proffurkom.ru/contacts.php');
      break;
    }

    default: {
      header('refresh: 25; url=http://proffurkom.ru/contacts.php');
      break;
    }
  }
}

// header('Location: ' . $_SERVER['HTTP_REFERER']);
$file = basename(__FILE__, '.php');
require './src/' . $file . '.html';

// NOTE: don't close!