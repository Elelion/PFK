<?php
require_once 'lib/RedirectNotSupportBrowser.php';
require_once 'lib/DbHelperPDO.php';

date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser();
$dbHelperPDO = new DbHelperPDO;

// **

// if (!$dbHelperPDO->getLastError()) {
//   $dbHelperPDO->executeQuery('SELECT * FROM `articles` ORDER BY id DESC');
// }

// $queryArticleResult = $dbHelperPDO->getQueryResult();

// foreach ($queryArticleResult as $row) {
//   $title = $row['title'];
//   $time = $row['time_create'];
//   $date = $row['date_create'];
//   $desc = $row['fullDescription'];
// }

// **

// $csv = str_getcsv(file_get_contents('import_1c.csv'));
// echo '<pre>';
// print_r($csv);
// echo '</pre>';


// $file = fopen('import_1c.csv', 'r');
// echo '<table cellspacing = "0" border = "1" width = "500">';

// while (!feof($file)) {
//   $mass = fgetcsv($file, 1024, ';');
//   $emptyStringCheck = count($mass);

//   if ($emptyStringCheck > 1) {
//     echo '<tr align = "center">';
//       for ($i = 0; $i < 10; $i++) {
//         echo '<td width = "25%">';
//           echo $mass[$i];
//         echo '</td>';
//       }
//     echo '</tr>';

//     $dbHelperPDO->executeQuery("INSERT INTO `table` (
//       `col1`,
//       ``,
//       ``,
//       ``,
//       ``,
//       ``,
//       ``,
//       ``,
//       ``,
//       ``)
//       VALUES ('{$mass[0]}', '{$mass[1]}', '{$mass[2]}','{$mass[3]}', '{$mass[4]}' ");
//   }

// }

// echo '</table>';
// fclose($file);

// **

$file = basename(__FILE__, ".php");
require './src/' . $file . '.html';

// TODO: don't close!