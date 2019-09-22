<?php
require_once 'lib/functions.php';
date_default_timezone_set('Europe/Moscow');

// **

$title = 'Заявка отправлена.';
$caption = 'Мы свяжемся с Вами в ближайшее время.';
$description = 'Вы будете перенаправлены на предыдущую страницу...';

// **

/**
 * NOTE:
 * 1 - contact page
 * 2 - service page
 */
$id = $_GET['idContact'];

// NOTE: delay of 3 seconds, to protect against spam bots
switch ($id) {
  case 1:
    header('refresh: 3; url=http://proffurkom.ru/contacts.php');
    break;

  default:
    break;
}

// header('Location: ' . $_SERVER['HTTP_REFERER']);

$file = basename(__FILE__, '.php');
require './src/' . $file . '.html';


//НЕ ЗАКРЫВАТЬ PHP!!!...