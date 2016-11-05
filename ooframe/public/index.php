<?php 
$students = DB::table("students")->get();
class DB extends PDO {
	private $engine; 
    private $host; 
    private $database; 
    private $user; 
    private $pass; 

	private static $_instance;
	private $table_name;

	public static function table($table_name) {
		if(!self::$_instance instanceof DB) {
			self::$_instance = new DB();
		}
		self::$_instance->table_name = $table_name;
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
		echo $this->table_name;
	}
}
 ?>