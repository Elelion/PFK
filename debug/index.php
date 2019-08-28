<?php
require_once 'lib/functions.php';
date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();

// **

$link = connectDB();
$sqlQuery = 'SELECT * FROM `articles` ORDER BY id DESC LIMIT 6';
$getResultData = requestSQL($link, $sqlQuery);

foreach ($getResultData as $row) {
  $titleDB = $row['title'];
  $miniDesc = $row['miniDescription'];
  $imageDB = $row['image_file'];
  $idDB = $row['id'];
}

$sqlQuery = 'SELECT * FROM articles ORDER BY id DESC LIMIT 2';
$countRow = requestSQL($link, $sqlQuery, 'count');
// echo "$countRow Rows\n";

// $link = connectDB();

// $sql = "SELECT * FROM category";
// $result = mysqli_query($link, $sql);

// NOTE: MYSQLI_ASSOC - возвращает массив в читабельном виде (типа матрици)
// $category_list = mysqli_fetch_all($result, MYSQLI_ASSOC);

// $sql_lot = "SELECT
//   title AS name,
//   start_price as price,
//   image_file as url,
//   lot.id, #добавляем для id по нему будет происходить линк на др. стр
//   category.name as category
//   FROM lot
//   INNER JOIN category ON lot.category_id = category.id";

// $result_lot = mysqli_query($link, $sql_lot);
// $product_list = mysqli_fetch_all($result_lot, MYSQLI_ASSOC);

// $test = new connectDBase('test', 'test', 'test', 'test');

$file = basename(__FILE__, ".php");
require './src/' . $file . '.html';

//НЕ ЗАКРЫВАТЬ PHP!!!...