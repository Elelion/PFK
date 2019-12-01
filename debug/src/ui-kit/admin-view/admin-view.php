<?php
if (!empty($_POST['importFile'])) {
  $fileName = 'import/' . $_POST['importFile'];

  if (file_exists($fileName)) {
    $importFile = fopen($fileName, 'r');

    echo '<table class = admin__import-view_table cellspacing = 0>';

    while (!feof($importFile)) {
      $string = fgetcsv($importFile, 1024, ';');
      $emptyStringCheck = count($string);

      if ($emptyStringCheck > 1) {
        echo '<tr>';

        for ($i = 1; $i < 4; $i++) {
          echo '<td>';
          echo $string[$i];
          echo '</td>';
        }

        echo '</tr>';
      }
    }

    echo '</table>';
    fclose($importFile);
  } else {
    echo 'file_exists = <b>false</b>. <br>Look in -> ' . __FILE__;
  }
}
