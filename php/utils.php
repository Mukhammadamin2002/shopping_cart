<?php 
function prettyDump($variable, $exit=false){
	echo "<pre>";
	var_dump($variable);
	echo "<pre>";

	if ($exit) {
		exit;
	}

}

?>