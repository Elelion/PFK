<?php
require_once 'lib/functions.php';

// ----------------------------------------------------------------------------

class RedirectNotSupportBrowser
{
	private $browser = null;
	private $userAgent = null;

	public function __construct()
	{
		$this->beginEvent();
	}

	private function redirect(string $page)
	{
		header('Location: ./' . $page . '.php');
	}

	private function detectBrowser(string $pageRedirect)
	{
		if (strpos($this->userAgent, 'Firefox') !== false)
			$this->browser = 'Firefox';
		else if (strpos($this->userAgent, 'Opera') !== false)
			$this->browser = 'Opera';
		else if (strpos($this->userAgent, 'Chrome') !== false)
			$this->browser = 'Chrome';
		else if (strpos($this->userAgent, 'MSIE') !== false)
			$this->browser = 'InternetExplorer';
		else if (strpos($this->userAgent, 'Safari') !== false)
			$this->browser = 'Safari';
		else $browser = 'Undefined';

		if ($this->browser === 'Safari' || $this->browser === 'Undefined') {
			$this->redirect($pageRedirect);
		}
	}

	private function beginEvent()
	{
		$this->browser = 'Undefined';
		$this->userAgent = $_SERVER["HTTP_USER_AGENT"];

		$this->detectBrowser('not-support');
	}
}

// ----------------------------------------------------------------------------

class DbHelper
{
	private $dbConnect;
	private $dbLastError = null;
	private $dbQueryResult = null;

	protected $host = null;
	protected $login = null;
	protected $password = null;
	protected $db = null;

	public function __construct()
	{
		$this->initConnect();

		$this->dbConnect =
			mysqli_connect($this->host, $this->login, $this->password, $this->db);

		mysqli_set_charset($this->dbConnect, 'utf8');

		if (!$this->dbConnect) {
			$this->dbLastError = 'ErrorNO: ' . mysqli_connect_errno() . PHP_EOL;
			$this->dbLastError .= '<br>';
			$this->dbLastError .= 'Error: ' . mysqli_connect_error() . PHP_EOL;
		}
	}

	// **

	protected function initConnect()
	{
		// FIXME: for build
		// $this->host = 'localhost';
		// $this->login = 'proffurkom';
		// $this->password = 'sm*d2*3kDK9s*';
		// $this->db = 'proffurkom';

		// FIXME: for debug
		$this->host = '127.0.0.1';
		$this->login = 'root';
		$this->password = '';
		$this->db = 'proffurkom';
	}

	// **

	public function executeQuery($query)
	{
		$request = mysqli_query($this->dbConnect, $query);
		$this->dbQueryResult = mysqli_fetch_all($request, MYSQLI_ASSOC);
	}

	// **

	public function getConnect()
	{
		return $this->dbConnect;
	}

	public function getQueryResult()
	{
		return $this->dbQueryResult;
	}

	public function getLastError()
	{
		return $this->dbLastError;
	}
}

// ----------------------------------------------------------------------------

class MailSend
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

  public function setSendMailMessage(string $msg)
  {
    $this->message = $msg;
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

  private function beginEvent()
  {
    $this->setSendMailHeader(
      'MIME-Version: 1.0' . "\r\n" .
      'Content-type: text/html; charset=utf-8'
    );
  }
}
?>