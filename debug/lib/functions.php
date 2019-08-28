<?php

class RedirectNotSupportBrowser {
	private $browser = null;
	private $userAgent = null;

	public function __construct() {
		$this->beginEvent();
	}

	private function redirect(string $page) {
		header('Location: ./' . $page . '.php');
	}

	private function detectBrowser(string $pageRedirect) {
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

	private function beginEvent() {
		$this->browser = 'Undefined';
		$this->userAgent = $_SERVER["HTTP_USER_AGENT"];

		$this->detectBrowser('not-support');
	}
}

// **

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

function elapsedTime($format = '%H Ч : %M M')
{
	// NOTE: tomorrow - означает, полночть
	$tsMidnight = strtotime('tomorrow');

	$secToMidnight = $tsMidnight - time();
	$result = gmstrftime($format, $secToMidnight);
	return $result;
}

// **

function connectDB()
{
	// FIXME: for build
	$link =
		// mysqli_connect('localhost', '*', '*', '*');

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
?>