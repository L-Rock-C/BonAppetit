<?php
	
include_once "connect.php";
include_once "header.php";

$erro = array();
$login = mysqli_escape_string($connect, $_POST['email']);
$password = mysqli_escape_string($connect, $_POST['password']);

if($login == "" or $password == ""){
	$erro[] = "Preencha ambos os campos.";
} else{
	$sql = "SELECT user_email FROM usuarios WHERE user_email = '$login'";
	$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result)){
		$sql = "SELECT * FROM usuarios WHERE user_email = '$login' AND user_pass_1 = '$password'";
		$result = mysqli_query($connect, $sql);
		if(mysqli_num_rows($result)){
			echo "Login efetuado com sucesso!";	
		} else{
			echo "Erro";
		}
	}
}

?>

	<div id="left_bar"></div>
	<div id="page_content">
		
	</div>
</body>
</html>