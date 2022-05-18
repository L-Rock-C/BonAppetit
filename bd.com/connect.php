<?php

$login = "root";
$password = "";
$server = "localhost";
$db = "dbprova";

$connect = mysqli_connect($server, $login, $password, $db);

if($connect){
	echo "Conexão bem sucedida";
}

?>