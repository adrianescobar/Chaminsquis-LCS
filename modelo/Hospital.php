<?php 
	require_once("Conection.php");
	class Hospital 
	{
		private $con;
		
		private $_id;
		private $_name;
		private $_address;
		private $_province;
		private $_phone;

		public function __construct()
		{
			
		}

		public function __construct($name, $address, $province, $phone)
		{
			$query = "insert into hospitales(nombre, direccion, provincia, telefono) values('{$name}', '{$address}', '{$province}', '{$phone}')";
			mysql_query($query);
		}

		public function id($id = null)
		{
			if($id != null)
			{
				$query = "select id_hospital nombre, direccion, provincia, telefono from hospitales where id = ".$id;
				$result = mysql_query($query);
				while($re = mysql_affected_rows($result))
				{
					$this->_id = $re['id_hospital'];
					$this->_name = $re['nombre'];
					$this->_address = $re['direccion'];
					$this->_province = $re['provincia'];
					$this->_phone = $re['telefono'];
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
				$query = "update hospitales set nombre = '{$name}' where id = ".$this->_id;
				mysql_query($query);			
			}
			else
			{
				return $this->_name;
			}
		}

		public function address($address = null)
		{
			if($this->_id != null && $address != null )
			{
				$query = "update hospitales set direccion = '{$address}' where id = ".$this->_id;		
				mysql_query($query);
			}
			else
			{
				return $this->_address;
			}
		}

		public function province($province = null)
		{
			if($this->_id != null && $this->_province)
			{
				$query = "update hospitales set provincia = '{$province}' where id = ".$this->_id;		
				mysql_query($query);					
			}
			else
			{
				return $this->_province;	
			}
		}

		public function phone($phone = null)
		{
			if($this->_id != null && $this->_phone != null)
			{
				$query = "update hospitales set telefono = '{$phone}' where id = ".$this->_id;		
				mysql_query($query);	
			}
		}


	}
?>