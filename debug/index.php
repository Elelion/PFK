<?php
require_once 'lib/functions.php';
date_default_timezone_set('Europe/Moscow');
RedirectNotSupportBrowser();

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

$is_auth = (bool) rand(0, 1);
$user_name = 'Константин';

$title = "Главная";

// print(render('index', [
//   'title' => $title,
//   'user_name' => $user_name,
//   'is_auth' => $is_auth,
//   // 'category_list' => $category_list
// ]));

$file = basename(__FILE__, ".php");
require './src/' . $file . '.html';

//НЕ ЗАКРЫВАТЬ PHP!!!...