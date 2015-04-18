 <?php
class DBConnection{
	public $host = 'localhost';
	public $schema = "mvc_share"; //nombre de la base de datos
	public $connectionString; //sql, pgsql tipo de bd
	public $username = 'root';
	public $password = 'root';
	public $connection;
	public $DBCommand;
	public static $instance = null;
	//new PDO

	public function __construct(){
		$this->DBCommand = new DBCommand();
		$this->connect();
	}
	public static function getInstance(){
		if (!isset(self::$instance)) {
			self::$instance = new DBConnection();
		}
		return self::$instance;
	} 

	public function connect(){
		try {
			$this->connectionString = 'mysql:host='.$this->host.';dbname='.$this->schema;
			$this->connection = new PDO($this->connectionString,$this->username,$this->password);
			return $this->connection;
		} catch (PDOException $e) {
		    print "¡Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}

	public function disconnect(){
		 $this->connection=null;
	}

	public function getDBCommand(){
		return $this->DBCommand;
	}

	public function getConnection(){
		return $this->connection;
	}
}

?>