<?php

$login = "root";
$password = "";
$server = "localhost";
$db = "dbprova";

$connect = mysqli_connect($server, $login, $password, $db);

if(mysqli_connect_error()){
	echo "Falha na conexão: ".mysqli_connect_error();
}


?>