<?php
require_once 'lib/functions.php';

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
		$this->host = 'localhost';
		$this->db = 'proffurkom';

		// FIXME: for build
		// $this->login = '...';
		// $this->password = '...';

		// FIXME: for debug
		$this->login = 'root';
		$this->password = '';
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
?>