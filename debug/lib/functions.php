<?php
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

// **

class DbHelper
{
	private $dbConnect;
	private $dbLastError = null;
	private $dbQueryResult = null;

	protected $host = null;
	protected $login = null;
	protected $password = null;
	protected $db = null;

	// **

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
		// ...

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

// ** ** ** **

function requestSQL($link, $sqlQuery, $type = null) {
	$sqlQueryData = $sqlQuery;
	$sqlRequestData = mysqli_query($link, $sqlQueryData);

	switch ($type) {
		case 'count':
			$result = mysqli_num_rows($sqlRequestData);
			break;

		default:
			$result = mysqli_fetch_all($sqlRequestData, MYSQLI_ASSOC);
			break;
	}
	return $result;
}

// **

function connectDB()
{
	// FIXME: for build
	$link =
		// mysqli_connect('localhost', 'proffurkom', 'sm*d2*3kDK9s*', 'proffurkom');

	// FIXME: for debug
	$link = mysqli_connect('127.0.0.1', 'root', '', 'proffurkom');

	mysqli_set_charset($link, 'utf8');

	if (!$link) {
		echo 'Ошибка: Невозможно установить соединение с MySQL.' . PHP_EOL;
		echo 'Код ошибки errno: ' . mysqli_connect_errno() . PHP_EOL;
		echo 'Текст ошибки error: ' . mysqli_connect_error() . PHP_EOL;
		exit;
	}

	return $link;
}

// **

function Error404()
{
	header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
	exit();
}

// **

function elapsedTime($format = '%H Ч : %M M')
{
	// NOTE: tomorrow - означает, полночть
	$tsMidnight = strtotime('tomorrow');

	$secToMidnight = $tsMidnight - time();
	$result = gmstrftime($format, $secToMidnight);
	return $result;
}
?>