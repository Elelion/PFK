<?php
require_once 'lib/functions.php';
require_once 'lib/FeedBackValidation.php';
require_once 'lib/MailSend.php';

date_default_timezone_set('Europe/Moscow');
$feedBack = new FeedBackValidation;

// TODO: indicate the current company email
$mailSend = new MailSend('elelion@yandex.ru');

/**/

$idType = $_GET['idType'];
if ( (empty($idType))
    || ($_SERVER['REQUEST_METHOD'] !== 'POST')
) {
	  header('Location: ./404.php');
	  die();
}

/**/

switch ($idType) {
    case 'contact':
        $feedBack->contactsValidation();

        $mailSend->sendForClient();
        $mailSend->sendMail();

        $mailSend->sendForCompanyFromContacts();
        $mailSend->sendMail();

        header('Location: ./alert.php?id=pageOk');
        break;

    case 'service':
        $feedBack->serviceValidation();

        $mailSend->sendForClient();
        $mailSend->sendMail();

        $mailSend->sendForCompanyFromService();
        $mailSend->sendMail();

        header('Location: ./alert.php?id=pageOk');
        break;

    // NOTE: error
    default:
        header('Location: ./alert.php?id=default');
        break;
}
