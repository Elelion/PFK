<?php
class ContactMailSend
{
  private $recipientMail = null;
  private $theme = null;
  private $message = null;
  private $headers = null;
  private $spam = null;

  public function __construct()
  {
    $this->spam = $_POST['spBtCheck'];

    $this->beginEvent();
  }

  // **

  private function setSendMailAddress(string $address)
  {
    $this->recipientMail = $address;
  }

  private function setSendMailTheme(string $theme)
  {
    $this->theme = $theme;
  }

  private function setSendMailMessage(string $msg)
  {
    $this->message = $msg;
  }

  private function setSendMailHeader(string $header)
  {
    $this->headers = $header;
  }

  // **

  public function sendForCompany()
  {
    $this->setSendMailAddress('elelion@yandex.ru');
    $this->setSendMailTheme('ПФК - заявка, контакты');
    $this->setSendMailMessage(
      'Данные отправителя: <br>' .
      'Имя: ' . trim(stripslashes($_POST['name'])) . '<br>' .
      'E-mail: ' . trim(stripslashes($_POST['email'])) . '<br>' .
      'Телефон: ' . trim(stripslashes($_POST['phone'])) . '<br>' .
      'Вопрос: ' . trim(stripslashes($_POST['message'])) . '<br>'
    );
  }

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

  // **

  public function sendMail()
  {
    // NOTE: spam check, if spam field is empty + if get data from POST
    if (empty($_POST['spBtCheck']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      mail($this->recipientMail, $this->theme, $this->message, $this->headers);
    }
  }

  // **

  private function beginEvent()
  {
    $this->setSendMailHeader(
      'MIME-Version: 1.0' . "\r\n" .
      'Content-type: text/html; charset=utf-8'
    );
  }
}

// **

function sendMailsFromContacts()
{
  $contactMailSend = new ContactMailSend();

  $contactMailSend->sendForClient();
  $contactMailSend->sendMail();

  $contactMailSend->sendForCompany();
  $contactMailSend->sendMail();
}

// **

/**
 * NOTE:
 * default - empty field error
 * mailError - email validation error
 * phoneError - phone validation error
 * contactPageOk - all validations it's ok
 */

if (empty($_POST['name']) || empty($_POST['phone']) || empty($_POST['email'])) {
  header('Location: ./alert.php?idContact=default');
} else {
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header('Location: ./alert.php?idContact=mailError');
  } else {
    if (!filter_var(!$_POST['phone'], FILTER_VALIDATE_FLOAT) &&
    strlen($_POST['phone']) < 11) {
      header('Location: ./alert.php?idContact=phoneError');
    } else {
      sendMailsFromContacts();
      header('Location: ./alert.php?idContact=contactPageOk');
    }
  }
}
?>