<?php 
require 'php/config.php';

function get_db(){
	if (!file_exists(__DIR__.'/'.DB_NAME)){
		$db_initial = [
			'products' => [],
		];

		file_put_contents(__DIR__.'/'.DB_NAME, json_encode($db_initial, JSON_PRETTY_PRINT));
		return $db_initial;
	}

	return json_decode(file_get_contents(__DIR__.'/'.DB_NAME), true);

}

function get_products(){
	return get_db()['products'];
}


?>