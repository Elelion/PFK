<?php
date_default_timezone_set('Europe/Moscow');

/**/

$file = basename(__FILE__, '.php');
require './src/' . $file . '.html';
