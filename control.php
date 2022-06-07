<?php

session_start();

include_once "connect.php";
include_once "header.php";

// --------- SIGN UP ------------//
	if(isset($_POST['sign_up_btn'])){
		unset($_POST['sign_up_btn']);
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


// --------- DELETE PROFILE ----------- //
	if(isset($_POST['delete_profile_btn'])){
		unset($_POST['delete_profile_btn']);
		$user_id = mysqli_escape_string($connect, $_POST['user_id']);
		$sql = "DELETE FROM usuarios WHERE user_id = '$user_id'";
		mysqli_query($connect, $sql);
		$sql = "DELETE FROM avaliacoes WHERE user_id = '$user_id'";
		mysqli_query($connect, $sql);
		$sql = "DELETE FROM restaurantes WHERE dono_id = '$user_id'";
		mysqli_query($connect, $sql);
		header('Location: index.php');
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
		unset($_POST['sign_up_rest_btn']);
		$erros = array();
		$rest = mysqli_escape_string($connect, $_POST['rest_nome']);
		$dono = $_SESSION['login'];
		$time_open = mysqli_escape_string($connect,$_POST['time_open']);
		$time_close = mysqli_escape_string($connect,$_POST['time_close']);
		$city = mysqli_escape_string($connect,$_POST['city']);
		$street = mysqli_escape_string($connect, $_POST['street']);
		$state = mysqli_escape_string($connect,$_POST['state']);
		$cep = mysqli_escape_string($connect,$_POST['cep']);

		$sql_check = "SELECT user_type FROM usuarios WHERE user_id = '$dono'";
		$result_check = mysqli_query($connect, $sql_check);
		if($result_check == 0){
			header('Location: erro.php');
		} else{
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
						header('Location: home_adm.php');
					} else{
						header('Location: erro.php');
					}
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


// --------- DELETE RESTAURANT ----------- //
	if(isset($_POST['confirm_delete_rest'])){
		unset($_POST['confirm_delete_rest']);
		$id_rest = mysqli_escape_string($connect, $_POST['id_rest']);
		$sql = "DELETE FROM restaurantes WHERE id_restaurante = '$id_rest'";
		mysqli_query($connect, $sql);
		$sql = "DELETE FROM cardapio WHERE id_rest = '$id_rest'";
		mysqli_query($connect, $sql);
		header('Location: home_adm');
	}


// --------- SIGN UP MENU ----------- //
	if(isset($_POST['sign_up_menu_btn'])){
		unset($_POST['sign_up_menu_btn']);
		$id_rest = mysqli_escape_string($connect, $_POST['id_rest']);
		$menu_name = mysqli_escape_string($connect, $_POST['menu_name']);

		if($menu_name == ""){
			$erros[] = "Todos os campos devem ser preenchidos.";
		}
		if(!empty($erros)){
			foreach($erros as $erro){
				echo "$erro";
			}
		} else{
			$insert = "INSERT INTO `cardapio`(`nome`, `id_rest`) VALUES ('$menu_name','$id_rest')";
			if(mysqli_query($connect, $insert)){
				header('Location: home_adm.php');
			} else{
				header('Location: erro.php');
			}
		}
	}


// --------- DELETE MENU ----------- //
	if(isset($_POST['delete_menu'])){
		unset($_POST['delete_menu']);
		$card_id = mysqli_escape_string($connect, $_POST['id_cardapio']);
		$sql = "DELETE FROM cardapio WHERE id = '$card_id'";
		mysqli_query($connect, $sql);
		header('Location: home_adm.php');
	}

// --------- DELETE ITEM ----------- //
	if(isset($_POST['confirm_delete_item'])){
		unset($_POST['confirm_delete_item']);
		$id_item = mysqli_escape_string($connect, $_POST['id_item']);
		$sql = "DELETE FROM itens WHERE id_item = '$id_item'";
		mysqli_query($connect, $sql);
		header('Location: menage_menu.php');
	}


// --------- ADD ITEM INTO MENU ---------- //
	if(isset($_POST['sign_up_item'])){
		unset($_POST['sign_up_item']);
		$nome = mysqli_escape_string($connect, $_POST['item']);
		$ingred = mysqli_escape_string($connect, $_POST['ingred']);
		$preco = mysqli_escape_string($connect, $_POST['valor']);
		$categ = mysqli_escape_string($connect, $_POST['categ']);
		$id_cardapio = mysqli_escape_string($connect, $_POST['id_cardapio']);

		$sql = "INSERT INTO `itens`(`nome`, `ingredientes`, `preco`, `categoria`, `id_cardapio`) VALUES ('$nome', '$ingred', '$preco', '$categ', '$id_cardapio')";
		if(mysqli_query($connect, $sql)){
			header('Location: menage_menu.php');
		} else{
			header('Location: erro.php');
		}
	}


// --------- SIGN UP RATE ---------- //
	if(isset($_POST['sign_up_rate_btn'])){
		unset($_POST['sign_up_rate_btn']);
		$id_rest = $_SESSION['restaurant_id'];
		$id_user = $_SESSION['login'];
		$rate_note = mysqli_escape_string($connect, $_POST['rate_note']);
		$rate_descri = mysqli_escape_string($connect, $_POST['rate_descri']);
		$rate_date = date("Y-m-d H:i:s");

		$sql = "INSERT INTO `avaliacoes`
		(`rest_id`, `user_id`, `rate_note`, `rate_descri`, `rate_date`) VALUES ('$id_rest', '$id_user', '$rate_note', '$rate_descri', '$rate_date')";
		if(mysqli_query($connect, $sql)){
			header('Location: client_view_rates.php');
		} else{
			echo $id_rest."<br>".$id_user."<br>".$rate_note."<br>".$rate_descri."<br>".$rate_date;
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
	// ---------- DELETE RESTAURANTE --------- //
		if(isset($_POST['delete_rest_btn'])){
			unset($_POST['delete_rest_btn']);
			$_SESSION['restaurant_id'] = mysqli_escape_string($connect, $_POST['rest_id']);
			header('Location: delete_rest.php');
		}
	// ---------- LIST MENU ---------- //
		if(isset($_POST['menu'])){
			unset($_POST['menu']);
			$_SESSION['restaurant_id'] = mysqli_escape_string($connect, $_POST['rest_id']);
			header('Location: adm_menu.php');
		}
	// ---------- VIEW MENU ---------- //
		if(isset($_POST['view_menu'])){
			unset($_POST['view_menu']);
			$_SESSION['restaurant_id'] = mysqli_escape_string($connect, $_POST['rest_id']);
			header('Location: view_menu.php');
		}
	// ---------- MENAGE MENU ---------- //
		if(isset($_POST['gerenciar_menu'])){
			unset($_POST['gerenciar_menu']);
			$_SESSION['id_cardapio'] = mysqli_escape_string($connect, $_POST['card_id']);
			header('Location: menage_menu.php');
		}
	// ---------- ADD MENU PAGE ---------- //
		if(isset($_POST['sign_up_menu_page'])){
			unset($_POST['sign_up_menu_page']);
			header('Location: sign_up_menu.php');
		}
	// ---------- DELETE ITEM ---------- //
		if(isset($_POST['delete_item_btn'])){
			unset($_POST['delete_item_btn']);
			$_SESSION['id_item'] = mysqli_escape_string($connect, $_POST['id_item']);
			header('Location: delete_item.php');
		}
	// ---------- CLIENTE VIEW MENU ---------- //
		if(isset($_POST['client_view_menu'])){
			unset($_POST['client_view_menu']);
			$_SESSION['id_rest'] = mysqli_escape_string($connect, $_POST['rest_id']);
			header('Location: client_view_menu.php');
		}
	// ---------- CLIENTE VIEW ITENS ---------- //
		if(isset($_POST['view_itens_menu'])){
			unset($_POST['view_itens_menu']);
			$_SESSION['id_card'] = mysqli_escape_string($connect, $_POST['card_id']);
			header('Location: client_view_itens_menu.php');
		}
	// ---------- CLIENTE SIGN UP RATE ---------- //
		if(isset($_POST['sign_up_rate'])){
			unset($_POST['sign_up_rate']);
			$_SESSION['restaurant_id'] = mysqli_escape_string($connect, $_POST['rest_id']);
			header('Location: client_sign_up_rate.php');
		}
	// ---------- CLIENTE VIEW RATES ---------- //
		if(isset($_POST['view_rates'])){
			unset($_POST['view_rates']);
			$_SESSION['restaurant_id'] = mysqli_escape_string($connect, $_POST['rest_id']);
			header('Location: client_view_rates.php');
		}


// --------- LOG OFF ----------- //
	if(isset($_POST['log_off'])){
		unset($_SESSION);
		header('Location: index.php');
	}

?>

	<div id="left_bar">
		<?php
		include_once 'navbar.php';
		?>
	</div>
	<div id="page_content">
	</div>
</body>
</html>