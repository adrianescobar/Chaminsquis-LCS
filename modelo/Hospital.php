<?php 
	require_once("Conection.php");
	class Hospital 
	{
		private $_con;
		
		private $_id;
		private $_name;
		private $_address;
		private $_province;
		private $_phone;

		private $_insurance;

		public function __construct($name = null, $address =null, $province = null, $phone = null, $_insurance = array())
		{	
			$this->_con = Conection::connect();
			$this->_name = $name;
			$this->_address = $address;
			$this->_province = $province;
			$this->_phone = $phone;
			$this->_insurance = $_insurance;
		}

		public function id($id = null)
		{
			if($id != null)
			{
				$query = "select id_hospital, nombre, direccion, provincia, telefono from hospitales where id_hospital = ".$id;

				$result = mysql_query($query);
				while($re = mysql_fetch_array($result))
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
				$this->_name = $name;	
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
				$this->_address = $address;
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
				$this->_province = $province;
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
				$this->_phone = $phone;	
			}
			else
			{
				return $this->_phone;
			}
		}

		public function find($var = 'and', $where = array())
		{
			$result = array();
			if(!is_null($var) && is_string($var) && is_array($where) && !is_null($where))
			{
				$conc = "";
				$size = count($where);
				foreach ($where as $key => $value) {
					$conc .= "{$key} = {$value}"; 
					if($size > 1)
					{
						$conc .= " {$var} ";		
					}
					$size--;
				}
				$query = "select * from hospitales where ".$conc;
				echo $query;
				$result = mysql_query($query);	
			}
			elseif (is_null($var) && is_array($where) && !is_null($where)) 
			{
				$size = count($where);
				if($size == 1)
				{
					$conc .= ""; 
				}
				$query = "select * from hospitales where ".$conc;
				echo $query;
				$result = mysql_query($query);	
			
			}
			return mysql_fetch_array($result);
		}

		public function delete($id = null)
		{
			if($id != null)
			{
				$query = "delete from hospitales where id_hospital = {$id}";
			}
			else
			{
				$query = "delete from hospitales where id_hospital = {$this->_id}";
				$this->_id = $this->_name = $this->_address = $this->_province = $this->_phone = $this->_insurance = null;
			}
			mysql_query($query);
		}

		public function save()
		{
			if($this->_id != null)
				$query = "insert into hospitales(nombre, direccion, provincia, telefono) values('{$this->_name}', '{$this->_address}', '{$this->_province}', '{$this->_phone}')";
			else
			{
				$query = "update hospitales set nombre = '{$this->_name}', direccion = '{$this->_address}', provincia = '{$this->_province}', telefono = '{$this->_address}' where id_hospital = {$this->_id}";	
			}
			mysql_query($query);
		}

	}
?>