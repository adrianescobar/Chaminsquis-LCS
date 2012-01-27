<?php 
	require_once("Conection.php");
	class Hospital 
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

		public 

	}
?>