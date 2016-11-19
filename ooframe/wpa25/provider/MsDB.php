<?php 
/*
DB Library for WPA25
 */

//SELECT
//DELETE
//INSERT
//UPDATE
//PAGINATION
//SEARCH

class MsDB extends PDO {

    private $engine; 
    private $host; 
    private $database; 
    private $user; 
    private $pass; 
	private static $_instance;
	private $table_name;
	
	private $select_status;
        private $select_sql;

        public function __construct() {
            $this->engine = Config::get("database.engine"); 
            $this->host = Config::get("database.hostname"); 
            $this->database = Config::get("database.dbname"); 
            $this->user = Config::get("database.username"); 
            $this->pass = Config::get("database.password"); 
            $dns = $this->engine.':dbname='.$this->database.";host=".$this->host; 
            parent::__construct( $dns, $this->user, $this->pass ); 
        }
	
	public function select(string ...$value) {
		$this->select_status = true;
		$this->select_sql = implode(",", $value); // id,name,address
		return $this;
		
	}
	public static function table($table_name) {
		if(!self::$_instance instanceof MsDB) {
			self::$_instance = new MsDB();
		}
		self::$_instance->table_name = $table_name;
		self::$_instance->select_status = false;
		return self::$_instance;
        }


        public function get() {

		if($this->select_status == true) {
			$sql = "SELECT " . $this->select_sql . " FROM " . $this->table_name;
		} else {
			$sql = "SELECT * FROM " . $this->table_name;	
                }

                return $this->fetchAll($sql);
        }

        public function insert($var){

            extract($this->convertToNameAndValue($var));
            $names = implode(", ", $names);
            $variables = implode(", ", $variables);
            $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", $this->table_name,
                            $names, $variables);
            return $this->exec($sql);
        }

        

        public function update($var, $id){

            extract($this->convertToNameAndValue($var));
            $updateColumns = [];
            for($i = 0; $i < sizeof($names); $i++)
            {
                $updateColumns[$i] = $names[$i] . " = " . $variables[$i];
            }
            $updateQuery = implode(",", $updateColumns);

            $sql = sprintf("UPDATE %s SET %s WHERE id = %s", $this->table_name,
                $updateQuery, $id);
           return $this->exec($sql);

        }

        public function delete($id){
            $sql = sprintf("DELETE FROM %s where id=%s", $this->table_name, $id);
            $stmt = $this->prepare($sql);
            return $stmt->execute();
        }

        public function where($vars){
            $constraint = array_map(function($var, $index){
                if( $index == 0 ){
                    return sprintf("WHERE %s %s '%s'", $var[0], $var[1], $var[2]);
                }else{
                    return sprintf("AND %s %s '%s'", $var[0], $var[1], $var[2]);
                }
            }, $vars, array_keys($vars));
            $where = implode(' ', $constraint);
            $sql = sprintf("SELECT  * FROM %s %s", $this->table_name, $where);
            return $this->fetchAll($sql);
        }

        public function paginate($page, $limit){
            $offset = ( ( $page * $limit ) - $limit );
            $sql = sprintf("SELECT  * FROM %s LIMIT %s,%s", $this->table_name, $offset, $limit);
            return $this->fetchAll($sql);
        }

        public function search($col, $val){

            $sql = sprintf("SELECT  * FROM %s where %s LIKE '%s'", $this->table_name, $col, $val);
            return $this->fetchAll($sql);
        }


        private function fetchAll($sql){

            $stmt = $this->prepare($sql);
            $stmt->execute();
	    return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } 

        private function convertToNameAndValue($var){

            $variables = $this->addSingleQuote(array_values($var));
            $names = array_keys($var);
            return ['names' => $names, 'variables' => $variables];
        }

        private function addSingleQuote($value){

            $var_array= array_map(function($var){
                return sprintf("'%s'", $var);
            },$value);
            return $var_array;
        }
}
 ?>
