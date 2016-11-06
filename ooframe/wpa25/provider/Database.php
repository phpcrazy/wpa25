<?php 

/*
DB Library for WPA25
*/

class DB extends PDO {
	private $engine; 
    private $host; 
    private $database; 
    private $user; 
    private $pass; 
	private static $_instance;
	private $table_name;
	
	private $select_status;
	private $select_sql;

	public function select(string ...$value) {
		$this->select_status = true;
		$this->select_sql = implode(",", $value); // id,name,address
		return $this;
		
	}
	public static function table($table_name) {
		if(!self::$_instance instanceof DB) {
			self::$_instance = new DB();
		}
		self::$_instance->table_name = $table_name;
		self::$_instance->select_status = false;
		return self::$_instance;
	}
	public function __construct() {
		$this->engine = Config::get("database.engine"); 
        $this->host = Config::get("database.hostname"); 
        $this->database = Config::get("database.dbname"); 
        $this->user = Config::get("database.username"); 
        $this->pass = Config::get("database.password"); 
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host; 
        parent::__construct( $dns, $this->user, $this->pass ); 
	}
	
	public function get() {
		if($this->select_status == true) {
			$sql = "SELECT " . $this->select_sql . " FROM " . $this->table_name;
		} else {
			$sql = "SELECT * FROM " . $this->table_name;	
		}
		
		$stmt = $this->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}


 ?>