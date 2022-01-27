<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT']);

include ROOT . "/orm/orm.php";
include ROOT . "/setup/config.php";

try {
	orm::setup(new mysqli($db_host, $db_user, $db_pass, 'books')) or die(orm::getError());
} 
catch(Exception $e) {
	echo "В ходе работы возникла ошибка";
}