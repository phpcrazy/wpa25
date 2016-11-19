<?php 
class HDB extends PDO {	

	private $engine; 
    private $host; 
    private $database; 
    private $user; 
    private $pass;

	private static $_instance;
	private $table_name;
	private $select_status;
	private $select_sql;
	private $insert_sql;
	private $delete_sql;
	private $where_sql;
	private $update_sql;
	private $where_status;
	private $filter_status;
	private $filter_sql;
	private $order_sql;
	private $order_status;
	private $paginate_sql;
	private $paginate_status;

	public static function table($table_name)
	{
		if(!self::$_instance instanceof HDB)
		{
			self::$_instance=new HDB();
		}
		self::$_instance->table_name=$table_name;
		self::$_instance->select_status=false;
		self::$_instance->where_status=false;
		self::$_instance->filter_status=false;
		self::$_instance->order_status=false;
		self::$_instance->paginate_status=false;
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

	public function select(string ...$value) // ...$value is open array(Facade pattern mar use mar moz)
	{

		$this->select_status= true;
		$this->select_sql = implode("," , $value); //implode is a built-in function that convert array to string
		return $this;
	}

	 public function insert($var){
      

           $variables = implode(" ',' ", array_values($var));
           $names = implode(", ", array_keys($var));

          

            $sql = sprintf("INSERT INTO %s (%s) VALUES ('%s')",$this->table_name,
            $names, $variables);

            var_dump($sql);
            die();

            return $this->exec($sql);
        }
		
	
	
	

		public  function delete($val){


		$variables = implode(" , ", array_values($val));
        $names = implode(", ", array_keys($val));

        var_dump($variables);
        var_dump($names);

      

		/*"delete from " . $this->table_name . " where id=" . $value*/
		$sql=sprintf("delete from %s where %s= '%s' ",$this->table_name,
            $names, $variables);

		var_dump($sql);

		$stmt= $this->prepare($sql);
		$stmt->execute();
		
		}


		public function update($val)
		{
			$update="";
			
			foreach ($val as $key => $value) {
				$update .=sprintf("%s= '%s', ", $key,$value );
				
			}
			$update[strlen($update)-2]= " ";
			
			
			if ($this->where_status == true)
			{

			$sql=sprintf("update %s set %s %s", $this->table_name,$update,$this->where_sql);
			
			}
			else
			{
				$sql=sprintf("update %s set %s", $this->table_name,$update);
			}
			var_dump($sql);

			
     		return $this->exec($sql);

		}

		public function filter($val)
		{
			$this->filter_status= true; //AND, OR, LIKE, <, >, <> , <=, >= , != 
			$this->filter_sql=$val;


			return $this;


		}

		public function order(string ...$value)
		{
			$this->order_status= true;
			$order=implode(" " , $value);
			$this->order_sql= sprintf("order by %s",$order);
			
			
			return $this;

		}

		public function where($val)
		{
			$sql="";
			$this->where_status= true;

			if($this->filter_status==true)
			{
				if($this->filter_sql=="or" || $this->filter_sql=="and")
				{
					$i=0;
					foreach ($val as $key => $value) {
					$sql .=sprintf(" %s= '%s' ", $key,$value);
					
					while ($i++ < sizeof($val)) { $sql .=$this->filter_sql; $i++; }
						
					}

				}
				elseif($this->filter_sql=="like")
				{
					foreach ($val as $key => $value)
					{
						
					$sql =sprintf(" %s %s '%s' ", $key,$this->filter_sql, $value);
					
					}
					
				}
				
				
			}
			else
			{
			foreach ($val as $key => $value) 
			$sql .=sprintf("%s= '%s' ", $key,$value );
			}

        	$this->where_sql = sprintf("where %s" ,$sql);
        	
        	return $this;

		}


		public function paginate($val)
		{
			$this->paginate_status=true;
			$value = ($val-1)*4;
			$this->paginate_sql=sprintf("limit 4 offset %s",$value);
			return $this;
		}


		public function get()
		{
		if ($this->select_status == true)
		{
			$sql="select " . $this->select_sql . " from " . $this->table_name;
			var_dump($sql);
		}
		else
		{$sql="select * from " . $this->table_name;}
	
		if($this->where_status == true)
		{
			$sql.=sprintf(" %s",$this->where_sql);
		}
		
		if($this->order_status == true)
		{
			$sql .=sprintf(" %s", $this->order_sql);
		}
		if($this->paginate_status ==true)
		{
			$sql .=sprintf(" %s", $this->paginate_sql);
		}
		var_dump($sql);
		

		$stmt= $this->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
?>