<?php
declare(strict_types=1);

require_once 'lib/functions.php';

class MailSend
{
    protected $companyMail = null;
    private $recipientMail = null;
    private $theme = null;
    private $message = null;
    private $headers = null;
    private $spam = null;
    private $token = null;

    public function __construct(string $companyMail = 'mail@domain.com')
    {
        $this->companyMail = $companyMail;
        $this->spam = $_POST['spBtCheck'];

        $this->tokenGenerate();
        $this->setSendMailHeader(
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8'
        );
    }

    /**/

    private function setSendMailHeader(string $header)
    {
        $this->headers = $header;
    }

    private function setSendMailTheme(string $theme)
    {
        $this->theme = $theme;
    }

    private function setSendMailAddress(string $address)
    {
        $this->recipientMail = $address;
    }

    private function setSendMailMessage(string $msg)
    {
        $this->message = $msg;
    }

    /**/

    protected function tokenGenerate()
    {
        $this->token = hash_pbkdf2(
            "sha256",
            uniqid(),
            openssl_random_pseudo_bytes(16),
            1000,
            40);
    }

    /**/

    public function sendForCompanyFromContacts()
    {
        $this->setSendMailAddress($this->companyMail);
        $this->setSendMailTheme('ПФК - заявка, контакты');
        $this->setSendMailMessage(
            'Данные отправителя: <br>' .
            'Имя: ' . trim(stripslashes($_POST['name'])) . '<br>' .
            'E-mail: ' . trim(stripslashes($_POST['email'])) . '<br>' .
            'Телефон: ' . trim(stripslashes($_POST['phone'])) . '<br>' .
            'Вопрос: ' . trim(stripslashes($_POST['message'])) . '<br>'
        );
    }

    public function sendForCompanyFromService()
    {
        $this->setSendMailAddress($this->companyMail);
        $this->setSendMailTheme('ПФК - заявка, Сервис');
        $this->setSendMailMessage(
            'Данные отправителя: <br>' .
            'Имя: ' . trim(stripslashes($_POST['name'])) . '<br>' .
            'E-mail: ' . trim(stripslashes($_POST['email'])) . '<br>' .
            'Телефон: ' . trim(stripslashes($_POST['phone'])) . '<br>' .
            'Адрес: ' . trim(stripslashes($_POST['address'])) . '<br>' .
            'Проблема: ' . trim(stripslashes($_POST['description'])) . '<br>' .
            'Вопрос: ' . trim(stripslashes($_POST['message'])) . '<br>'
        );
    }

    /**/

    public function sendForClient()
    {
        $this->setSendMailAddress($_POST['email']);
        $this->setSendMailTheme('ПФК - статус обращения');
        $this->setSendMailMessage(
            'Здравствуйте, <br>' .
            'Ваше, обращение принято в обработку. <br>' .
            'В ближайшее время мы ответим Вам на ваш вопрос в письме,' .
            'или свяжемся с Вами по указанному телефону. <br>'
        );
    }

    public function sendTokenForClient(string $mail)
    {
      $this->setSendMailAddress($mail);
      $this->setSendMailTheme('ПФК - подтверждение учетной записи');
      $this->setSendMailMessage(
        'Здравствуйте, <br>' .
        'Вы успешно создали учетную запись на нашем сайте . <br>' .
        'Что бы подтвердить ее, перейдите по ниже указанной ссылке: <br><br>' .
        'https://proffurkom.ru/verify.php?id=/' . $this->token
      );
    }

    /**/

    public function sendMail()
    {
        // NOTE: spam check, if spam field is empty + if get data from POST
        if ( (empty($_POST['spBtCheck']))
            && ($_SERVER['REQUEST_METHOD'] === 'POST')
        ) {
            mail(
                $this->recipientMail,
                $this->theme,
                $this->message,
                $this->headers
            );
        }
    }
}
