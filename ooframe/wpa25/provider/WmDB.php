<?php 

/*
DB Library for WPA25
*/

class WmDB extends PDO {
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
		if(!self::$_instance instanceof WmDB) {
			self::$_instance = new WmDB();
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
	
	public function get(string ...$value) {	
		foreach($value as $key => $values){
			if(!is_numeric($values)){
				$error_msg = "<h1 style='color:blue;'>All values should be numberic.</h1>";		
			}
		}
		if(empty($error_msg)){
			if((sizeof($value) > 2) ||(sizeof($value) == 1)){
				echo "<h1 style='color:blue;'>Insert two parameters!!!!!!!!!!!</h1>";
				return false;
			}else if(sizeof($value) == 0){
				$limit_values = "";		
			}else{
				$limit_values = " LIMIT ".implode(",", $value);		
			}
		}else{
			echo $error_msg;
			return false;
		}
			
		if($this->select_status == true) {
			$sql = "SELECT " . $this->select_sql . " FROM " . $this->table_name.$limit_values;
		} else {
			$sql = "SELECT * FROM " . $this->table_name.$limit_values;	
		}
		
		$stmt = $this->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function insert($var){		
			$field_name = "";
			$field_value = "";
            foreach($var as $key => $value){

            	$field_name .= $key . ",";
            	$field_value .= "'".$value . "',";
            }
            
            $field_name = rtrim($field_name,",");
            $field_value = rtrim($field_value,",");

            $sql = "INSERT INTO ".$this->table_name." ($field_name) VALUES ($field_value)";            
            return $this->exec($sql);
     }        

    public function update($var,$var1){
    	$set_value   = array();
    	$where_value = array();
    	foreach($var as $key => $value){
    		$set_value[] = $key."=".sprintf("'%s'",$value);
    	}
    	if((sizeof($var1)== "0") || (sizeof($var)== "0")){
    		echo "<h1 style='color:blue;'>Any array should not be blank!!!!!!</h1>";
    		return false;
    	}else{
    		foreach($var1 as $key => $value){
    			$where_value[] = $key."=".sprintf("'%s'",$value);
    		}
    	}

    	$set_value_string   = implode(",",$set_value);
    	$where_value_string = implode(" AND ",$where_value);
    	
    	$sql = "UPDATE " .$this->table_name." SET ".$set_value_string." WHERE ". $where_value_string;
    	
    	$this->exec($sql);
    	echo "<p><h2 style='color:green;'>Update Success</h2></p>";
    }

	public function delete($id){
		 $sql = "DELETE FROM ".$this->table_name." WHERE `students`.`id` =  $id ";
		 echo "<p><h2 style='color:red;'>Delete Success</h2></p>";	
		 $stmt = $this->prepare($sql);
		 $stmt->execute();
		 return $stmt->fetchAll(PDO::FETCH_ASSOC);			 
	}

	public function search($var){
		$search_value = array();		
		foreach($var as $key => $value){
			$search_value[] = $key." LIKE '%".$value."%'";	
		}
		$set_value_string = implode(" AND ",$search_value);
		
		$sql = "SELECT * FROM ".$this->table_name." WHERE ".$set_value_string;		
		$stmt = $this->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);		
	}	
}


?>