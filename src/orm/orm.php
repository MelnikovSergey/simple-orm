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

	static function getError() 
	{
		return self::$db->error . "[". self::$db->errno ."]";
	}
	
}