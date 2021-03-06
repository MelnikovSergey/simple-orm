<?php

class ORM {
	
	private static $db;

	static function setup($dbi, $enc = "utf-8") 
	{
		if(is_object($dbi)) {
			self::$db = $dbi;
		}	
		else {
			throw new Exception("Параметр $dbi не является объектом", 1);
			return false;
		}
	}

	static function setEncoding($enc) 
	{
		return self::$db->query("SET NAMES `$enc`");
	}

	static function query($query) 
	{
		return self::$db->query($query);
	}

	static function findID($id) 
	{
		if(is_numeric($id)){
			$query = "SELECT * FROM `" . get_called_class() . "`WHERE`" . key(get_class_vars(get_called_class())) . "` = $id LIMIT 1";
			$result = self::$db->query($query);

			if($result->num_rows == 1) {
				// Возвращаем экземпляр
				$row = $result->fetch_object();

				$className = get_called_class();

				$returnClass = new $className();

				foreach($row as $key => $value) {
					$returnClass->$key = $value;
				}

				return $returnClass;

			} else {
				return false;
			}

		} else {
			throw new Exception("Параметр $id содержит данные другого типа", 1);
			return false;
		}
	}

	static function Remove($removeClass) 
	{
		if(!is_object($removeClass)){
			return false;
		}
		
		$id = key(get_class_vars(get_called_class()));

		if(!empty($removeClass->$id)){
			$query = "DELETE * FROM `" . get_called_class() . "`WHERE `$id` = " . $removeClass->$id ."LIMIT 1";

			return self::$db->query($query);
		} else {
			return false;
		}
	}

	static function Truncate() 
	{
		$query = "TRUNCATE TABLE " . get_called_class();
		return self::$db->query($query);
	}

	static function getError() 
	{
		return self::$db->error . "[". self::$db->errno ."]";
	}
	
}