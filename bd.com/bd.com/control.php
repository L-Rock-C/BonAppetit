<?php

session_start();

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

		if($nome =="" or $sobrenome == "" or $login == "" or $password == "" or $password_2 == ""){
			$erros[] = "O Campo login/senha precisa ser preenchidos.";
		}
		if(!empty($erros)){
			foreach($erros as $erro){
				echo "$erro";
			}
		} else{
			$sql = "SELECT user_email FROM usuarios WHERE user_email = '$login'";
			$result = mysqli_query($connect, $sql);
			if(mysqli_num_rows($result) > 0){
				echo "Cadastro inválido: este email já está cadastrado.";
			} else{
				$insert = "INSERT INTO `usuarios`(`user_name`, `user_surname`, `user_email`, `user_pass_1`, `user_pass_2`, `user_type`) VALUES ('$nome','$sobrenome','$login','$password','$password_2', '$tipo')";
				if(mysqli_query($connect, $insert)){
					unset($_POST['sign_up_btn']);
					header('Location: index.php');
				} else{
					header('Location: erro.php');
				}
			}
		}
	}


// --------- UPDATE PROFILE ----------- //
	if(isset($_POST['update_profile_btn'])){
		$erros = array();
		$user_id = $_SESSION['login'];
		$nome = mysqli_escape_string($connect, $_POST['nome']);
		$sobrenome = mysqli_escape_string($connect,$_POST['sobrenome']);
		$email = mysqli_escape_string($connect,$_POST['email']);
		$pass = mysqli_escape_string($connect,$_POST['password']);
		$pass_2 = mysqli_escape_string($connect, $_POST['password_2']);
		if($nome =="" or $sobrenome == "" or $email == "" or $pass == "" or $pass_2 == ""){
			$erros[] = "Os campos devem ser preenchidos.";
		}
		if(!empty($erros)){
			foreach($erros as $erro){
				echo "$erro";
			}
		} else{		
			$insert = "UPDATE usuarios SET
			`user_name` = '$nome', 
			`user_surname` = '$sobrenome', 
			`user_email` = '$email', 
			`user_pass_1` = '$pass', 
			`user_pass_2` = '$pass_2' 
			WHERE user_id = '$user_id'";
			if(mysqli_query($connect, $insert)){
				unset($_POST['updade_profile_btn']);
				$user_id = $_SESSION['login'];
				$sql = "SELECT user_type FROM usuarios WHERE user_id = '$user_id'";
				$result = mysqli_query($connect, $sql);
				$inf = mysqli_fetch_assoc($result);
				if($inf['user_type']){
					header('Location: home_client.php');
				} else{
					header('Location: home_adm.php');
				}
			} else{
				header('Location: erro.php');
			}
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
						$sql = "SELECT user_id FROM usuarios WHERE user_email = '$login'";
						$result = mysqli_query($connect, $sql);
						$row = mysqli_fetch_array($result);
						$_SESSION['login'] = $row['user_id'];
						unset($_POST['log_in_btn']);
						header('Location: home_client.php');
					}
					$sql = "SELECT * FROM usuarios WHERE user_email = '$login' AND user_type = '0'";
					$result = mysqli_query($connect, $sql);
					if(mysqli_num_rows($result)){
						$sql = "SELECT user_id FROM usuarios WHERE user_email = '$login'";
						$result = mysqli_query($connect, $sql);
						$row = mysqli_fetch_array($result);
						$_SESSION['login'] = $row['user_id'];
						unset($_POST['log_in_btn']);
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


// --------- SIGN UP RESTAURANT ----------- //
	if(isset($_POST['sign_up_rest_btn'])){
		$erros = array();
		$rest = mysqli_escape_string($connect, $_POST['rest_nome']);
		$dono = $_SESSION['login'];
		$time_open = mysqli_escape_string($connect,$_POST['time_open']);
		$time_close = mysqli_escape_string($connect,$_POST['time_close']);
		$city = mysqli_escape_string($connect,$_POST['city']);
		$street = mysqli_escape_string($connect, $_POST['street']);
		$state = mysqli_escape_string($connect,$_POST['state']);
		$cep = mysqli_escape_string($connect,$_POST['cep']);
		if($rest =="" or $time_open == "" or $time_close == "" or $city == "" or $street == "" or $state == "" or $cep == ""){
			$erros[] = "Todos os campos devem ser preenchidos.";
		}
		if(!empty($erros)){
			foreach($erros as $erro){
				echo "$erro";
			}
		} else{
			$sql = "SELECT nome FROM restaurantes WHERE nome = '$rest'";
			$result = mysqli_query($connect, $sql);
			if(mysqli_num_rows($result) > 0){
				echo "Cadastro inválido: este nome já está em uso.";
			} else{
				$insert = "INSERT INTO `restaurantes`(`nome`, `dono_id`, `hora_ini`, `hora_fim`, `estado`, `cidade`, `rua`, `cep`) VALUES ('$rest','$dono','$time_open','$time_close','$state', '$city', '$street', '$cep')";
				if(mysqli_query($connect, $insert)){
					unset($_POST['sign_up_rest_btn']);
					header('Location: home_adm.php');
				} else{
					header('Location: erro.php');
				}
			}
		}
	}


// --------- UPDATE RESTAURANT ----------- //
	if(isset($_POST['update_rest_btn'])){
		$erros = array();
		$rest_id = $_SESSION['restaurant_id'];
		$rest = mysqli_escape_string($connect, $_POST['rest_nome']);
		$dono = $_SESSION['login'];
		$time_open = mysqli_escape_string($connect,$_POST['time_open']);
		$time_close = mysqli_escape_string($connect,$_POST['time_close']);
		$city = mysqli_escape_string($connect,$_POST['city']);
		$street = mysqli_escape_string($connect, $_POST['street']);
		$state = mysqli_escape_string($connect,$_POST['state']);
		$cep = mysqli_escape_string($connect,$_POST['cep']);
		$func = mysqli_escape_string($connect, $_POST['func']);
		if($rest =="" or $time_open == "" or $time_close == "" or $city == "" or $street == "" or $state == "" or $cep == ""){
			$erros[] = "Todos os campos devem ser preenchidos.";
		}
		if(!empty($erros)){
			foreach($erros as $erro){
				echo "$erro";
			}
		} else{		
			$insert = "UPDATE restaurantes SET
			`nome` = '$rest', 
			`hora_ini` = '$time_open', 
			`hora_fim` = '$time_close', 
			`estado` = '$state', 
			`cidade` = '$city', 
			`rua` = '$street', 
			`cep` = '$cep', 
			`funcionando` =  '$func' 
			WHERE id_restaurante = '$rest_id'";
			if(mysqli_query($connect, $insert)){
				unset($_POST['sign_up_rest_btn']);
				header('Location: home_adm.php');
			} else{
				header('Location: erro.php');
			}
		}
	}


// --------- REDIRECT PAGES ---------- //
	// ---------- MENAGE RESTAURANT ---------- //
		if(isset($_POST['gerenciar_rest'])){
			unset($_SESSION['restaurant_id']);
			$_SESSION['restaurant_id'] = mysqli_escape_string($connect, $_POST['rest_id']);
			unset($_POST['gerenciar_rest']);
			header('Location: menage_rest.php');
		}
	// ---------- MENAGE MENU ---------- //


// --------- LOG OFF ----------- //
	if(isset($_POST['log_off'])){
		unset($_SESSION);
		header('Location: index.php');
	}

?>

	<div id="left_bar">
		<div id="left_bar">
			<input type="button" name="back_btn" id="back_btn" onclick="history.go(-1)">
		</div>
	</div>
	<div id="page_content">
		<h3></h3>
	</div>
</body>
</html>