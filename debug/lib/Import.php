<?php
declare(strict_types=1);

require_once 'lib/DbHelperPDO.php';

class Import
{
    public $fileName = null;
    public $tableName = null;
    private $dbHelperPDO = null;

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
        if (!file_exists($file)) {
            throw new Exception('File does not exists');
        }
    }

    private function checkFileExtension($file): void
    {
        if (pathinfo($file, PATHINFO_EXTENSION) !== 'csv') {
            throw new Exception('Invalid file extension');
        }
    }

    private function checkFileSize($file): void
    {
        if (filesize($file) === 0) {
            throw new Exception('File is empty');
        }
    }

    private function checkErrors(): void
    {
        $this->checkFileExist($this->getFileName());
        $this->checkFileExtension($this->getFileName());
        $this->checkFileSize($this->getFileName());
    }

    /**/

    private function writeInTable($value, $tableName): void
    {
        if (count($value) > 1) {
            if (!$this->dbHelperPDO->getLastError()) {
                $this->dbHelperPDO->executeQuery("INSERT INTO $tableName
                    (title, price, image)
                    VALUES ('$value[1]', '$value[2]', '$value[3]')");
            }
        }
    }

    /**/

    public function beginEvent(): void
    {
        $this->checkErrors();
        $importFile = fopen($this->getFileName(), 'r');

        while (!feof($importFile)) {
            $value = fgetcsv($importFile, 1024, ';');
            $this->writeInTable($value, $this->getTableName());
        }

        fclose($importFile);
    }
}
