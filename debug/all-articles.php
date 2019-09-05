<?php
require_once 'lib/functions.php';
date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();

// **

$link = connectDB();
$sqlQuery = 'SELECT * FROM `articles` ORDER BY id DESC';
$getResultData = requestSQL($link, $sqlQuery);

foreach ($getResultData as $row) {
  $titleDB = $row['title'];
  $miniDesc = $row['miniDescription'];
  $imageDB = $row['image_file'];
  $idDB = $row['id'];
}

$file = basename(__FILE__, ".php");
require './src/' . $file . '.html';

//НЕ ЗАКРЫВАТЬ PHP!!!...