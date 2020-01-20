<?php
declare(strict_types=1);

class FeedBackValidation
{
    private $basic = [];
    private $advanced = [];
    private $physical = [];
    private $legal = [];

    public function __construct()
    {
        $this->initBasicValue();
        $this->initAdvancedValue();

        $this->initPhysicalValue();
        $this->initLegalValue();
    }

    /**/

    private function initBasicValue(): void
    {
        $this->basic = [
            'name'  => $_POST['name'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email']
        ];
    }

    private function initAdvancedValue(): void
    {
        $this->advanced = [
            'address'   => $_POST['address'],
            'desc'      => $_POST['description'],
            'message'   => $_POST['message']
        ];
    }

    private function initPhysicalValue(): void
    {
        $this->physical = [
            'surname'   => $_POST['surname-physical'],
            'name'      => $_POST['name-physical'],
            'phone'     => $_POST['phone-physical'],
            'email'     => $_POST['email-physical'],
            'address'   => $_POST['address-physical'],
            'password'  => $_POST['password-physical']
        ];
    }

    private function initLegalValue(): void
    {
        $this->legal = [
            'org'       => $_POST['organization-legal'],
            'inn'       => $_POST['inn-legal'],
            'phone'     => $_POST['phone-legal'],
            'email'     => $_POST['email-legal'],
            'city'      => $_POST['city-legal'],
            'address'   => $_POST['address-legal'],
            'password'  => $_POST['password-legal']
        ];
    }

    /**/

    private function checkEmpty(string $target): void
    {
        if (empty($target)) {
            header('Location: ./alert.php?id=default');
            die();
        }
    }

    private function checkLength(string $target, int $length, $redirect): void
    {
        if (strlen($target) < $length) {
            header("Location: ./alert.php?id=$redirect");
            die();
        }
    }

    private function checkPhone(string $target, $redirect): void
    {
        if ((!is_numeric($target)) || (strlen($target)) < 11) {
            header("Location: ./alert.php?id=$redirect");
            die();
        }
    }

    private function checkMail(string $target, $redirect): void
    {
        if (!filter_var($target, FILTER_VALIDATE_EMAIL)) {
            header("Location: ./alert.php?id=$redirect");
            die();
        }
    }

    /**/

    public function contactsValidation(): void
    {
        foreach ($this->basic as $key => $value) {
            $this->checkEmpty($value);
        }

        $this->checkLength($this->basic['name'], 2, 'nameError');
        $this->checkPhone($this->basic['phone'], 'phoneError');
        $this->checkMail($this->basic['email'], 'mailError');
    }

    public function serviceValidation(): void
    {
        foreach ($this->advanced as $key => $value) {
            $this->checkEmpty($value);
        }

        $this->contactsValidation();
        $this->checkLength($this->advanced['address'], 10, 'addressError');
        $this->checkLength($this->advanced['desc'], 15, 'descriptionError');
        $this->checkLength($this->advanced['message'], 5, 'messageError');
    }

    public function registrationPhysicalValidation(): void
    {
        foreach ($this->physical as $key => $value) {
            $this->checkEmpty($value);
        }

        $this->checkLength($this->physical['surname'], 2, 'surnameError');
        $this->checkLength($this->physical['name'], 2, 'nameError');
        $this->checkPhone($this->physical['phone'], 'phoneError');
        $this->checkMail($this->physical['email'], 'mailError');
        $this->checkLength($this->physical['address'], 10, 'addressError');
        $this->checkLength($this->physical['password'], 2, 'passwordError');
    }

    public function registrationLegalValidation(): void
    {
        foreach ($this->legal as $key => $value) {
            $this->checkEmpty($value);
        }

        $this->checkLength($this->legal['org'], 5, 'orgError');
        $this->checkLength($this->legal['inn'], 10, 'innError');
        $this->checkPhone($this->legal['phone'], 'phoneError');
        $this->checkMail($this->legal['email'], 'mailError');
        $this->checkLength($this->legal['city'], 3, 'cityError');
        $this->checkLength($this->legal['address'], 10, 'addressError');
        $this->checkLength($this->legal['password'], 2, 'passwordError');
    }
}
