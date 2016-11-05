<?php 

$stus = DB::table("students")->select("id", "name", "address")->get();
var_dump($stus);
$students = DB::table("students")->get();
var_dump($students);

// SELECT id, name, address FROM students;
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
		$this->engine = 'mysql'; 
        $this->host = 'localhost'; 
        $this->database = 'wpa25db'; 
        $this->user = 'root'; 
        $this->pass = ''; 
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