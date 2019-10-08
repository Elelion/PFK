<?php
require_once 'lib/functions.php';

date_default_timezone_set('Europe/Moscow');

// **

$file = basename(__FILE__, ".php");
require './src/' . $file . '.html';

// TODO: don't close!