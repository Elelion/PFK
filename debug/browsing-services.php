<?php
require_once 'lib/functions.php';
date_default_timezone_set('Europe/Moscow');

// **

$link = connectDB();

// **

// NOTE: services list
if (empty($_GET['idServices'])) {
  Error404();
} else {
  $id = mysqli_real_escape_string($link, $_GET['idServices']);
  $sql_query = "SELECT * FROM main_service WHERE id = '$id'";

  $result = mysqli_query($link, $sql_query);
  $resultList = mysqli_fetch_all($result, MYSQLI_ASSOC);

  foreach ($resultList as $row) {
    $title = $row['typeService'];
    $desc = $row['descriptionService'];
  }
}

// **

$file = basename(__FILE__, '.php');
require './src/' . $file . '.html';

// TODO: don't close!