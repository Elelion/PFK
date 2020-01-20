<?php
require_once 'lib/RedirectNotSupportBrowser.php';
require_once 'lib/DbHelperPDO.php';
require_once 'lib/FeedBackValidation.php';
require_once 'lib/MailSend.php';
require_once 'lib/UserRegistration.php';
//require_once 'lib/UserSession.php';

date_default_timezone_set('Europe/Moscow');
new RedirectNotSupportBrowser;
$dbHelperPDO = new DbHelperPDO;
$mailSend = new MailSend;
$feedBack = new FeedBackValidation;
//$userSession = new UserSession;

/**/

if ( (empty($_GET['id']))
    || ($_SERVER['REQUEST_METHOD'] !== 'POST')
    || (!isset($_POST['registrationBtn']))
) {
    header('Location: ./404.php');
}

/**/

$id = htmlspecialchars($_GET['id']);
switch ($id) {
    case 'physical':
//      new UserRegistration('legal');

        $emailLegal = trim(htmlspecialchars($_POST['email-legal']));
//      $mailSend->sendTokenForClient($emailLegal);
//      $mailSend->sendMail();

        $feedBack->registrationPhysicalValidation();

//        header('Location: ./alert.php?id=registrationOk');
      break;

      // NOTE: legal
      default:
          $feedBack->registrationLegalValidation();
          new UserRegistration('legal');
          break;
}

/*

SELECT category.class_name FROM task
JOIN category ON category.id = task.category_id
WHERE task.id = 1

Создай дополнительную таблицу для хранения токенов.
Вроде token(user_id, type, value, is_used, expired_at, created)
user_id - ключ для связи с пользователем
type - тип токена (подтверждение регистрации, восстановление пароля и тд)
value - значение токена
is_used - флаг использован или нет
expired_at - дата, после которой токен будет считать недействительным
created - дата создания (так, для себя)

И генерируй токен как рандомный хэш
Ссылку на мыло кидай ?token=[значение токена]
Как пользователь попадает на страницу, ищешь не использованный,
действительный токен с соответствующим значением. Находишь токен,
по токену находишь пользтваеля, проставляешь флаг, что он прошёл активацию.
Не находишь токен - говоришь, что он не найден или недействителен
токен - хешированный рандомный ключ: ZGo774guf98zt8Guzfkhgzgoi7tOGZvgzu
*/

/**/

$file = basename(__FILE__, ".php");
require './src/' . $file . '.html';
