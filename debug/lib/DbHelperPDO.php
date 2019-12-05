<?php
require_once 'lib/functions.php';

class DbHelperPDO
{
	private $dbConnect;
	private $dbLastError = null;
	private $dbQueryResult = null;

  protected $driver = null;
	protected $host = null;
  protected $db = null;
  protected $charset = null;
	protected $login = null;
	protected $password = null;

	public function __construct()
	{
    $this->initConnect();

    try {
			$this->dbConnect =
				new PDO("$this->driver:host=$this->host;dbname=$this->db",
					"$this->login",
					"$this->password",
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "$this->charset")
				);
    } catch (PDOException $e) {
      $this->dbLastError = 'Подключение не удалось: ' . $e->getMessage();
      $this->dbConnect = null;

      echo $this->dbLastError;
    }
	}

	/**/

	protected function initConnect()
	{
		$this->driver = 'mysql';
		$this->host = 'localhost';
		$this->db = 'proffurkom';
		$this->charset = 'SET NAMES utf8';

		// FIXME: for build


		// FIXME: for debug
		$this->login = 'root';
		$this->password = '';
	}

	/**/

	public function executeQuery($query)
	{
		$result = $this->dbConnect->query($query);
		$this->dbQueryResult = $result->fetchAll(PDO::FETCH_ASSOC);
	}

  /**/

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
