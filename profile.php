<?php

session_start();	

include_once "connect.php";
include_once "header.php";


?>
<div id="home_page">	
	<?php
		include_once 'navbar.php';
	?>
	<div id="page_content" style="margin-left: 400px;">
		<div id="page_top">
				<h2>Gerencie seu perfil no Bon Appétit</h2>
			</div>
			<?php
				$user = $_SESSION['login'];
				$sql = "SELECT * FROM usuarios WHERE user_id = '$user'";
				$result = mysqli_query($connect, $sql);
				$inf = mysqli_fetch_assoc($result);
			?>
			<form id="sign_up_form" action="control.php" method="POST">
				<table id="sign_up_table">
					<tr>
						<td>Nome</td>
						<td class="space"></td>
						<td>Sobrenome</td>
						<td></td>
					</tr>
					<tr>
						<td><input class="input_sign_up" type="text" name="nome" placeholder="Insira seu nome" value="<?php echo $inf['user_name']; ?>"></td>
						<td></td>
						<td><input class="input_sign_up" type="text" name="sobrenome" placeholder="Insira seu sobrenome" value="<?php echo $inf['user_surname']; ?>"></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="3">Endereço de e-mail</td>
					</tr>
					<tr>
						<td colspan="3"><input class="input_email" type="email" name="email" placeholder="exemplo@email.com" value="<?php echo $inf['user_email']; ?>"></td>
					</tr>
					<tr>
						<td>Senha</td>
						<td></td>
						<td>Confirmar senha</td>
					</tr>
					<tr>
						<td><input class="input_sign_up" type="password" name="password" placeholder="********" value="<?php echo $inf['user_pass_1']; ?>"></td>
						<td></td>
						<td><input class="input_sign_up" type="password" name="password_2" placeholder="********" value="<?php echo $inf['user_pass_2']; ?>" onchange="Check_Pass()"></td>
					</tr>
				</table>
				<input type="hidden" name="user_id" value="<?php echo $_SESSION['login']; ?>">
				<div id="btn_submit">
					<input type="submit" name="update_profile_btn" value="Atualizar perfil">
					<input type="submit" name="delete_profile_btn" value="Excluir perfil">
				</div>
			</form>
		</div>
	</div>
</body>
</html>