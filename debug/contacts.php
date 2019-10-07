<?php
require_once 'lib/classes.php';
date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();

// **

$file = basename(__FILE__, '.php');
require './src/' . $file . '.html';

// TODO: don't close!