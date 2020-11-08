<?php
	class Database{	
		var $conn;
		function __construct(){	
            $this->conn = new mysqli("localhost","root","","erp_cart_mstr") or die($this->conn->error);	
            /*$data = mysqli_fetch_all($this->conn->query("select * from v_disp_short_vendor"));
            printf(count($data));*/

		}
		function insert($table,$data,$message="")
	    {
            try{
                $key= array_keys($data);
                $value= array_values($data);
                $query = "insert into $table (".implode(',',$key).") values('".implode("','",$value) ."')";
				//										printf("<script>alert(".$query.")</script>");
				//print($query);
				$q = $this->conn->query($query);
                return $q;
            }
            catch(PharException $e){
                return $q;
            }
			
	    }
		function select($field,$table,$where="1")
		{
			//($field=='')?$field = '*':$field = implode(',',$field);	
			
			if($field=='')
			{
				$field = '*';
			}
			else if(is_array($field))
			{
				$field = implode(',',$field);
			}			
			/*return "select ".$field." from ".$table." where ".$where."";			
			die();*/
			//echo("select ".$field." from ".$table." where ".$where."");		
			return $this->conn->query("SELECT ".$field." FROM ".$table." WHERE ".$where."");
			//return "select ".$field." from ".$table." where ".$where."";
		}
		function delete($table,$where="")
		{
			return $this->conn->query("delete from ".$table." Where ".$where);
		}
		function update($table,$data,$where="")
		{
			$s = "";$c=1;			
			if(is_array($data)){
				
				foreach($data as $key => $values)
				{ 
					$s .= $key."='".$values."'";
					if(count($data)!=$c)
					{$s .= ","; }
					$c++;
				}	
			}
			else
				$s=$data;
			//echo "update ".$table." set ".$s." where ".$where;
			 // die();
			//printf("<script>alert(update ".$table." set ".$s." where ".$where.")</script>");		
			return $this->conn->query("UPDATE ".$table." SET ".$s." WHERE ".$where);
			//return "update ".$table." set ".$s." where ".$where;
			
		}
		function fetch_assoc($result)
		{
			return $result->fetch_assoc();
		}	
		public function retrieve($name)
		{
			if(!empty($_COOKIE[$name])) {
				return $_COOKIE[$name];
			}
			return false;
		}
		function fetch_num($result)
		{
			return $result->num_rows;
			
		}
		
	}
?>