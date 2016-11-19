<?php 
/*
DB Library for WPA25
*/

// SELECT 	done
// DELETE 	done
// INSERT 	done
// UPDATE 	done
// PAGINATION 	
// SEARCH 	

class HhDB extends PDO {

    private $engine; 
    private $host; 
    private $database; 
    private $user; 
    private $pass; 
	private static $_instance;

	private $table_name;
	private $columns;
	private $values;
	private $where;
	private $orderby;
	
	private $select_status;
	private $sql;
	private $arr;
	private $count;

	public function __construct() {
		$this->engine = Config::get("database.engine"); 
        $this->host = Config::get("database.hostname"); 
        $this->database = Config::get("database.dbname"); 
        $this->user = Config::get("database.username"); 
        $this->pass = Config::get("database.password"); 
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host; 
        parent::__construct( $dns, $this->user, $this->pass ); 
	}

	public static function table($table_name) {
		if(!self::$_instance instanceof HhDB) {
			self::$_instance = new HhDB;
		}
		self::$_instance->table_name = $table_name;
		self::$_instance->select_status = false;
		self::$_instance->sql = "";
		self::$_instance->arr = "";
		self::$_instance->count = "";

		return self::$_instance;
	}

	public function select(string ...$col) {	//string ...$value

		$this->select_status = true;
		$columns = implode(",", $col); // id,name,address
		$this->sql = "SELECT " . $columns . " FROM " . $this->table_name;
		return $this;
	}

	public function where(){
		$args = func_get_args();
		$val = "'" . end($args) . "'";	array_pop($args);
		$where_clause = implode(" ",$args);
		$this->sql .= " WHERE " .  $where_clause . " " . $val;
		return $this;
	}

	public function order_by($column, $sort="ASC"){
		if($sort == "ASC"){
			$this->sql .= " ORDER BY " .  $column;
		}else{
			$args = func_get_args();
			$order_by = implode(" ",$args);
			$this->sql .= " ORDER BY " .  $order_by;
		}
		return $this;
	}

	public function group_by($column){
		$this->sql .= " GROUP BY " .  $column;
		return $this;
	}

	public function get() {
		if(!$this->select_status){
			$this->sql = "SELECT * FROM " . $this->table_name;
		}
		//var_dump($this->sql);die;
		$stmt = $this->prepare($this->sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function insert(){
    	$args = func_get_args();
    	for($i=0; $i<count($args); $i++){
    		$arr = $args[$i];
			$this->columns = implode(",", array_keys($arr));
	    	$this->values = "'".implode("','", array_values($arr))."'";
	 		$sql = "insert into ".$this->table_name." (".$this->columns.") value (".$this->values.")";
	 		$this->exec($sql);
    	}
    	return $this;
	}

	public function insertGetId($args){
		$this->columns = implode(",", array_keys($args));
    	$this->values = "'".implode("','", array_values($args))."'";
 		$sql = "INSERT INTO ".$this->table_name." (".$this->columns.") VALUE (".$this->values.")";
 		$this->exec($sql);
 		return $this->lastInsertId();
	}

	public function update($args){
		$this->columns = implode(",", array_keys($args));
    	$this->values = "'".implode("','", array_values($args))."'";
    	$sql = "UPDATE ".$this->table_name." SET ".$this->columns." = ".$this->values." ".$this->sql;
    	return $this->exec($sql);
	}

	public function delete(){
        $sql = "DELETE FROM " . $this->table_name . $this->sql;
        return $this->exec($sql);
    }

    public function truncate(){
    	$sql = "TRUNCATE TABLE ".$this->table_name;
    	return $this->exec($sql);
    }
     
    public function pagination($var){
     	$sql = "SELECT 	COUNT(*) as rows FROM ".$this->table_name;
     	$stmt = $this->prepare($sql);
		$stmt->execute();
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC); 
		$total = $rows[0];
     	$perpage = $var;
		$posts  = $total["rows"];
		$pages  = ceil($posts / $perpage);
		
		for($i=1; $i<=$perpage; $i++){
			if($i==1){
				$sql = "SELECT * FROM ".$this->table_name." LIMIT " . $pages;
				$stmt = $this->prepare($sql);
				$stmt->execute();
				$this->arr =$stmt->fetchAll(PDO::FETCH_ASSOC);
				$this->count+=$pages;
			}else{
				$sql = "SELECT * FROM ".$this->table_name." LIMIT " . $pages . " OFFSET " . $this->count;
				$stmt = $this->prepare($sql);
				$stmt->execute();
				array_push($this->arr ,$stmt->fetchAll(PDO::FETCH_ASSOC));
				$this->count+=$pages;
			}
		}
		return $this->arr;

		
		// $row_count = $stmt->fetchColumn(0);
		// var_dump($row_count);die;
     }  
}
?>
