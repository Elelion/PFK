<?php
require_once 'lib/functions.php';
date_default_timezone_set('Europe/Moscow');

if (empty($_GET['idServices'])) {
  Error404();
}

// **

$link = connectDB();
$id = mysqli_real_escape_string($link, $_GET['idServices']);

// echo($_GET['idServices']);

if ($_GET['idServices']) {
  echo $_GET['idServices'];
}

switch ($_GET['idServices']) {
  case 'idServices':
    echo 'idServices';
    break;
}

$sql_query = "SELECT * FROM main_service WHERE id = '$id'";

$result = mysqli_query($link, $sql_query);
$resultList = mysqli_fetch_all($result, MYSQLI_ASSOC);

// **

foreach ($resultList as $row) {
  $title = $row['typeService'];
  $desc = $row['descriptionService'];
}

// **

$file = basename(__FILE__, '.php');
require './src/' . $file . '.html';

// TODO: don't close!