<?php
function DBConnect(){
	$db_host = '127.0.0.1';
	$db_user = 'root';
	$db_password = '1234';
	$db_database = 'game';
	$link = mysqli_connect($db_host, $db_user, $db_password, $db_database);
}
?>
