<?php
	include_once "connect.php";
	include_once "header.php";

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
?>

	<div id="home_page">
		<div id="left_bar"></div>
		<div id="page_content">
			<h3>
			<?php
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
							header('Location: index.php?sucesso');
						} else{
							header('Location: erro.php');
						}
					}
				}
			?>
			</h3>
			<div id="btn_submit" style="margin-top:400px">
				<input type="button" name="sign_up_btn" value="Voltar">
			</div>
		</div>
	</div>
</body>
</html>