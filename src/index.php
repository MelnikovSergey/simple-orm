<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT']);

include "debug.php";

include ROOT . "/orm/orm.php";
include ROOT . "/setup/config.php";

class Books extends ORM {
	public $id;
	public $title;
	public $original_title;
	public $author_id;
	public $year;
	public $annotation;
	public $ISBN;
	public $rating;
}

class Genres extends ORM {
	public $id;
	public $title;
}

class Authors extends ORM {
	public $id;
	public $full_name; 
}

try {
	orm::setup(new mysqli($db_host, $db_user, $db_pass, 'books')) or die(orm::getError());

	$book = books::findID(1);
	
	echo "<pre>";
	print_r($book);
	echo "</pre>";
	echo __FILE__ . ': ' . __LINE__;

	$genre = genres::findID(8);

	echo "<pre>";
	print_r($genre);
	echo "</pre>";
	echo __FILE__ . ': ' . __LINE__;

	$author = authors::findID(1);

	echo "<pre>";
	print_r($author);
	echo "</pre>";
	echo __FILE__ . ': ' . __LINE__;
} 
catch(Exception $e) {
	echo "В ходе работы возникла ошибка";
}