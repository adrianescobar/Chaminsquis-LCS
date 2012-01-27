<?php 
	require_once('../config.php');
	class Conection
	{
		private static $instance;

		private function __construct()
		{
			$con = mysql_connect(SERVER, USER, PASSWORD);
			mysql_select_db(DATABASE, $con);
			echo "conectado";
		}

		public function __destruct()
		{
			mysql_close();
		}

		public static function connect() 
		{
			if(!isset(self::$instance))
			{
				self::$instance = new Conection();
			}
			return self::$instance;
		}

		public function __clone()
		{
			die("Can't clone this.");
		}
	}
?>