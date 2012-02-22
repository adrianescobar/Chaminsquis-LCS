<?php 
	require_once("con/Conection.php");

	class Insurance 
	{
		private $_con;
		
		private $_id;
		private $_name;
		private $_hospitals;

		public function __construct($name = null, $_hospitals = array())
		{	
			$this->_con = Conection::connect();
			$this->_name = $name;
			$this->_insurance = $_hospitals;
		}

		public function id($id = null)
		{
			if($id != null)
			{
				$query = "select id_seguro, nombre from seguros where id_seguro = ".$id;
				
				$result = mysql_query($query);
				while($re = mysql_fetch_array($result))
				{
					$this->_id = $re['id_seguro'];
					$this->_name = $re['nombre'];
				}

				$query = "select * from seguros where id_seguro = {$this->_id}";
				$result = mysql_query($query);
				$this->_hospitals = mysql_fetch_array($result);
			}
			else
			{
				return $this->_id;
			}	
		}

		public function name($name = null)
		{
			if($this->_id != null && $name != null )
			{
				$this->_name = $name;	
			}
			else
			{
				return $this->_name;
			}
		}

		public function all()
		{
			$query = "select * from hospitales";
			$result = mysql_query($query);
			return mysql_fetch_array($result);
		}
		public function find($var = 'and', $where = array())
		{
			$result = array();
			$conc = "";
			if(!is_null($var) && is_string($var) && is_array($where) && !is_null($where))
			{
				$size = count($where);
				foreach ($where as $key => $value) 
				{
					$conc .= "{$key} = '{$value}'"; 
					if($size > 1)
					{
						$conc .= " {$var} ";		
					}
					$size--;
				}	
			}
			elseif (is_null($var) && is_array($where) && !is_null($where)) 
			{
				$conc = "";
				$size = count($where);
				if($size == 1)
				{
					foreach ($where as $key => $value) 
					{
					 	$conc .= "{$key} = '{$value}'";
					} 
				}
			}
			$query = "select * from seguros where ".$conc;
			$result = mysql_query($query);
			return mysql_fetch_array($result);
		}
		
		public function delete($id = null)
		{
			if($id != null)
			{
				$query = "delete from seguros where id_seguro = {$id}";
			}
			else
			{
				$query = "delete from seguros where id_seguro = {$this->_id}";
				$this->_id = $this->_name = $this->_hospitals = null;
			}
			mysql_query($query);
		}

		public function save()
		{
			if($this->_id != null)
				$query = "insert into seguros(nombre) values('{$this->_name}')";
			else
			{
				$query = "update hospitales set nombre = '{$this->_name}' where id_seguro = {$this->_id}";	
			}
			mysql_query($query);
		}

		public function hospitals(Hospital $hospital = null)
		{
			if(!is_null($hospital))
			{
				$query = "insert into hospital_seguro(id_hospital, id_seguro) values ($hospital->id(), $this->_id)";	
			}
			else
			{
				return $this->_hospitals;
			}
		}

	}
?>