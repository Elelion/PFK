<?php
require_once 'lib/MailSend.php';

// ----------------------------------------------------------------------------

/**
 * NOTE:
 * bottom two functions
 * new MailSend() -> classes.php -> MailSend
 * for validation func (look down)
 */
function sendMailsFromContacts()
{
	$contactMailSend = new MailSend();

	$contactMailSend->sendForClient();
	$contactMailSend->sendMail();

	$contactMailSend->sendForCompany();
	$contactMailSend->sendMail();

	header('Location: ./alert.php?id=pageOk');
}

/**/

function sendMailsFromService()
{
	$serviceMailSend = new MailSend();

	$serviceMailSend->sendForClient();
	$serviceMailSend->sendMail();

	$serviceMailSend->setSendMailMessage(
		'Данные отправителя: <br>' .
		'Имя: ' . trim(stripslashes($_POST['name'])) . '<br>' .
		'E-mail: ' . trim(stripslashes($_POST['email'])) . '<br>' .
		'Телефон: ' . trim(stripslashes($_POST['phone'])) . '<br>' .
		'Адрес: ' . trim(stripslashes($_POST['address'])) . '<br>' .
		'Проблема: ' . trim(stripslashes($_POST['description'])) . '<br>' .
		'Вопрос: ' . trim(stripslashes($_POST['message'])) . '<br>'
	);

	$serviceMailSend->sendMail();

	header('Location: ./alert.php?id=pageOk');
}

// ----------------------------------------------------------------------------

// NOTE: for mail-send.php
function validation($type)
{
  // NOTE: basic validation (for contact form)
	if ((empty($_POST['name']))
    || (empty($_POST['phone']))
    || (empty($_POST['email'])))
		  header('Location: ./alert.php?id=default');
	else if (strlen($_POST['name']) < 2)
		header('Location: ./alert.php?id=nameError');
	else if (!is_numeric($_POST['phone']) || strlen($_POST['phone']) < 11)
		header('Location: ./alert.php?id=phoneError');
	else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		header('Location: ./alert.php?id=mailError');
	else if ($type === 'basic')
		// NOTE: look in the functions
		sendMailsFromContacts();

	// NOTE: advanced validation (for service form)
	else if ((empty($_POST['address']))
		|| (empty($_POST['description']))
		|| (empty($_POST['message'])))
			header('Location: ./alert.php?id=default');
	else if (strlen($_POST['address']) < 10)
		header('Location: ./alert.php?id=addressError');
	else if (strlen($_POST['description']) < 15)
		header('Location: ./alert.php?id=descriptionError');
	else if (strlen($_POST['message']) < 5)
		header('Location: ./alert.php?id=messageError');
	else
		// NOTE: look in the functions
		sendMailsFromService();
}

// ----------------------------------------------------------------------------

// NOTE: check if the session was defined or not
function sessionCheck()
{
	if (!isset($_SESSION['user'])) {
		unset($_SESSION['user']);
		session_destroy();

		header('Location: ./');
		exit();
	}
}

// ----------------------------------------------------------------------------

function elapsedTime($format = '%H Ч : %M M')
{
	// NOTE: tomorrow -> mindight
	$tsMidnight = strtotime('tomorrow');

	$secToMidnight = $tsMidnight - time();
	$result = gmstrftime($format, $secToMidnight);
	return $result;
}
