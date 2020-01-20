<?php
declare(strict_types=1);

require_once 'lib/DbHelperPDO.php';

class UserRegistration
{
    private $physical = [];
    private $legal = [];

    private $dbHelperPDO = null;
    private $type = null;

    public function __construct(string $type)
    {
        $this->type = $type;
        $this->dbHelperPDO = new DbHelperPDO;

        if ($this->type === 'legal') {
            $this->initLegalValue();
            $this->recordLegal();
        } else {
            $this->initPhysicalValue();
            $this->recordPhysical();
        }
    }

    /**/

    private function initLegalValue(): void
    {
        $this->legal = [
            trim(htmlspecialchars($_POST['organization-legal'])),
            trim(htmlspecialchars($_POST['inn-legal'])),
            trim(htmlspecialchars($_POST['phone-legal'])),
            trim(htmlspecialchars($_POST['email-legal'])),
            trim(htmlspecialchars($_POST['city-legal'])),
            trim(htmlspecialchars($_POST['address-legal'])),
            password_hash($_POST['password-legal'], PASSWORD_DEFAULT)
        ];
    }

    private function initPhysicalValue(): void
    {
        $this->physical = [
            trim(htmlspecialchars($_POST['name-physical'])),
            trim(htmlspecialchars($_POST['surname-physical'])),
            trim(htmlspecialchars($_POST['patronymic-physical'])),
            trim(htmlspecialchars($_POST['phone-physical'])),
            trim(htmlspecialchars($_POST['email-physical'])),
            trim(htmlspecialchars($_POST['address-physical'])),
            password_hash($_POST['password-physical'], PASSWORD_DEFAULT)
        ];
    }

    /**/

    private function getUsersFromDb(): array
    {
        if (!$this->dbHelperPDO->getLastError()) {
            $this->dbHelperPDO->executeQuery('SELECT * FROM `users`
                ORDER BY login');

            return $this->dbHelperPDO->getQueryResult();
        } else {
            echo $this->dbHelperPDO->getLastError();
        }
    }

    private function checkUniquenessLogin(string $type = 'legal'): void
    {
        $mail = ($type === 'legal') ? $this->legal[3] : $this->physical[4];

        $queryUsersResult = $this->getUsersFromDb();
        foreach ($queryUsersResult as $row) {
            if ($mail === $row['login']) {
                header('Location: ./alert.php?id=registrationBusyLogin');
                die();
            }
        }
    }

    private function writeInTable(array $value): void
    {
        $this->dbHelperPDO->executeQuery("INSERT INTO users
            (organization, inn, phone, login, city, address, password)
            VALUES (
                '$value[0]',
                '$value[1]',
                '$value[2]',
                '$value[3]',
                '$value[4]',
                '$value[5]',
                '$value[6]'
            )
        ");
    }

    /**/

    private function recordLegal(): void
    {
        $this->checkUniquenessLogin();
        $this->writeInTable($this->legal);
    }

    private function recordPhysical(): void
    {
        $this->checkUniquenessLogin('physical');
        $this->writeInTable($this->physical);
    }
}
