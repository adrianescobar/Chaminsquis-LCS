<?php 
	require_once("con/Conection.php");
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

				$query = "select * from seguros where id_seguro = {$this->_id}";
				$result = mysql_query($query);
				$this->_insurance = mysql_fetch_array($result);	
		
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

		public function all()
		{
			$query = "select * from hospitales";
			$result = mysql_query($query);
			return mysql_fetch_array($result);
		}
		/*public function find($where = array(), $var = null, $since = 0, $fromTo = 0)
		{
			$conc = "";
			if(!is_null($var) && is_string($var) && is_array($where) && !is_null($where))
			{
				$conc = "where ";
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
			elseif (is_null($var) && is_numeric($var) && is_array($where) && !is_null($where)) 
			{
				$conc = "where ";
				$size = count($where);
				if($size == 1)
				{
					foreach ($where as $key => $value) 
					{
					 	$conc .= "{$key} = '{$value}'";
					} 
				}
			}
			elseif(is_null($var) && is_null($where))
			{

			}

			if($fromTo != 0)
			{
				$conc .= " limit ".$since.",".$fromTo;
			}
			//$query = "select * from hospitales ".$conc;
			
			$query = "select distinct* from hospitales limit 0, 10;";
			$result = mysql_query($query);	
			while($re = mysql_fetch_row($result))
			{
				$ret[] = $re;
			}
			return $ret;
		}*/
		public function find($nameIns, $namePro)
		{
			$query = "select h.nombre, h.direccion, h.provincia, h.telefono from hospitales h inner join hospital_seguro hs on h.id_hospital = hs.id_hospital inner join seguros s on hs.id_seguro = s.id_seguro where h.provincia = '{$namePro}' and s.nombre = '{$nameIns}'";
			
			$result = mysql_query($query);

			$numeroFila = 0;
			
			echo "{ \"hospitales\" : [ ";

			while($re = mysql_fetch_array($result))
			{
				echo "{\"nombre\":\"{$re['nombre']}\",\"direccion\":\"{$re['direccion']}\"}";
				// echo "{\"nombre\":\"{$re['nombre']}\",\"direccion\":\"{$re['direccion']}\",\"telefono\":\"{$re['telefono']}\"}";

				$numeroFila++;
				if($numeroFila!=mysql_num_rows($result))
				{
					echo ",";
				}
				
			}

			echo "]}";

			// echo "{ \"hospitales\":[{\"nombre\":\"luis\"},{\"nombre\":\"luis\"}] }";

			
		}
		/*public function find($select = array(), $where = array(), $andOr = "", $groupBy = "";
		{
			$query = "";

			if(!is_null($select) && is_array($select))
			{
				$query = "select ";
				foreach ($select as $key => $value) {
					$query .= $value . ", ";
				}	
			}
			if(!is_null($where) && is_array($where) && !is_null($andOr) && is_string($andOr))
			{
				$query .= "where "
				$size = count($where);
				foreach ($where as $key => $value) {
					$query .= $key . " = " . $value;
					if(size > 1)
						$query .= " ".$andOr;
				}
			}
			if(!is_null($groupBy) && !is_array($andOr))
			{
				$query .= "group by ".$groupBy;
			}
			$result = mysql_query($query);
			while($re = mysql_fetch_array($result))
			{
				$ret[] = $re;
			}		
			return $ret;
		}
		*/
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

		public function hospitals()
		{
			return $this->_insurance;
		}
	}
?>