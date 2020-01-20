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

	public function getQueryResult()
	{
		  return $this->dbQueryResult;
	}

	public function getLastError()
	{
		  return $this->dbLastError;
	}
}

/**/

// TODO: make it
// class DbHelperPDO
// {
//     private static $instance;
//     private function __construct()
//     {
//     }
//     private function __clone()
//     {
//     }
//     private function __wakeup()
//     {
//     }
//     /**
//      * @param array $config
//      * @throws Exception
//      *
//      * @return PDO
//      */
//     public static function getInstance(array $config = []): PDO
//     {
//         if (!self::$instance) {
//             if (!$config) {
//                 throw new Exception('Please provide a config');
//             }
//             extract($config);
//             self::$instace = new PDO(
//                 "{$driver}:host={$host};dbname={$dbname}",
//                 $username,
//                 $password,
//                 [PDO::MYSQL_ATTR_INIT_COMMAND => "$charset"]
//             );
//         }
//         return self::$instance;
//     }
// }
// $helper = DbHelperPDO::getInstance([
//     'driver'   => 'mysql',
//     'host'     => 'localhost',
//     'dbname'   => 'database',
//     'username' => 'root',
//     'password' => 'password',
//     'charset'  => 'utf8',
// ]);
