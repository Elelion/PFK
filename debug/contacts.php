<?php
require_once 'lib/RedirectNotSupportBrowser.php';

date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();

// **

$file = basename(__FILE__, '.php');
require './src/' . $file . '.html';

// TODO: don't close!