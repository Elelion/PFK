<?php
require_once 'lib/DbHelperPDO.php';

class Import
{
  public $fileName = null;
  public $tableName = null;

  private $importFile = null;
  private $query = null;
  private $dbHelperPDO = null;
  private $errors = false;

  public function __construct()
  {
    $this->dbHelperPDO = new DbHelperPDO;
  }

  /**/

  public function setFileName($name): void
  {
    $this->fileName = 'import/' . $name;
  }

  public function setTableName($name): void
  {
    $this->tableName = $name;
  }

  /**/

  private function getFileName()
  {
    return $this->fileName;
  }

  private function getTableName()
  {
    return $this->tableName;
  }

  /**/

  private function checkFileExist($file): void
  {
    $this->errors = (file_exists($file)) ? false : true;
  }

  private function checkErrors(): void
  {
    $this->checkFileExist($this->getFileName());
  }

  /**/

  public function beginEvent(): void
  {
    $this->checkErrors();

    if ($this->errors === false) {
      $tableName = $this->getTableName();
      $importFile = fopen($this->getFileName(), 'r');

      while (!feof($importFile)) {
        $string = fgetcsv($importFile, 1024, ';');
        $emptyStringCheck = count($string);

        if ($emptyStringCheck > 1) {
          if (!$this->dbHelperPDO->getLastError()) {
            $this->dbHelperPDO->executeQuery("INSERT INTO $tableName
              (title, price, image)
              VALUES ('$string[1]', '$string[2]', '$string[3]')");
          }
        }
      }

      fclose($importFile);
    }
  }
}
