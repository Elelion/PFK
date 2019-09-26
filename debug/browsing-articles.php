<?php
require_once 'lib/functions.php';
date_default_timezone_set('Europe/Moscow');

// **

$link = connectDB();

// **

// NOTE: services list
if (empty($_GET['idArticles'])) {
  Error404();
} else {
  $id = mysqli_real_escape_string($link, $_GET['idArticles']);
  $sqlQuery = "SELECT * FROM articles WHERE id = '$id'";

  $result = mysqli_query($link, $sqlQuery);
  $resultList = mysqli_fetch_all($result, MYSQLI_ASSOC);

  foreach ($resultList as $row) {
    $title = $row['title'];
    $time = $row['time_create'];
    $date = $row['date_create'];
    $desc = $row['fullDescription'];
  }
}

// **

$file = basename(__FILE__, '.php');
require './src/' . $file . '.html';

// NOTE: don't close!