<?php

include_once "connect.php";
include_once "header.php";

// --------- SIGN UP ------------//
	if(isset($_POST['sign_up_btn'])){
		$erros = array();
		$nome = mysqli_escape_string($connect, $_POST['nome']);
		$sobrenome = mysqli_escape_string($connect, $_POST['sobrenome']);
		$login = mysqli_escape_string($connect, $_POST['email']);
		$password = mysqli_escape_string($connect, $_POST['password']);
		$password_2 = mysqli_escape_string($connect, $_POST['password_2']);
		$tipo = mysqli_escape_string($connect, $_POST['tipo_conta']);
		echo $tipo;

		if($nome =="" or $sobrenome == "" or $login == "" or $password == "" or $password_2 == ""){
			$erros[] = "O Campo login/senha precisa ser preenchidos.";
		}
	}

// --------- LOG IN ----------- //
	if(isset($_POST['log_in_btn'])){
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
					$sql = "SELECT * FROM usuarios WHERE user_email = '$login' AND user_type = '1'";
					$result = mysqli_query($connect, $sql);
					if(mysqli_num_rows($result)){
						header('Location: home_client.php');
					}
					$sql = "SELECT * FROM usuarios WHERE user_email = '$login' AND user_type = '0'";
					$result = mysqli_query($connect, $sql);
					if(mysqli_num_rows($result)){
						header('Location: home_adm.php');
					}
				} else{
					header('Location: erro.php');	
				}
			} else{
				header('Location: erro.php');
			}
		}
	}

?>

	<div id="left_bar"></div>
	<div id="page_content"></div>
</body>
</html>