<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "stationery";
$db_name2 = "bookstore";


$stt = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
$bks = mysqli_connect($db_host, $db_user, "", $db_name2);

if(mysqli_connect_errno()){
	echo 'No se pudo conectar a la base de datos : '.mysqli_connect_error();
}
?>
