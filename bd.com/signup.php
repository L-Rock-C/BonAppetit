<?php
	include_once "header.php";
?>

	<div id="home_page">
		<div id="left_bar"></div>
		<div id="page_content">
			<div id="page_top">
				<a href="index.php"><img src="images/back_btn.png"></a>
				<h2>Faça seu cadastro no Bon Appétit</h2>
			</div>
			<form id="sign_up_form" action="sign_up.php" method="POST">
				<table id="sign_up_table">
					<tr>
						<td>Nome</td>
						<td class="space"></td>
						<td>Sobrenome</td>
						<td style="padding-left: 20px;">Tipo de Conta</td>
					</tr>
					<tr>
						<td><input class="input_sign_up" type="text" name="nome" placeholder="Insira seu nome"></td>
						<td></td>
						<td><input class="input_sign_up" type="text" name="sobrenome" placeholder="Insira seu sobrenome"></td>
						<td>
							<select class="input_sign_up" style="margin-left: 20px;">
								<option>Cliente</option>
								<option>Administrador</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="3">Endereço de e-mail</td>
					</tr>
					<tr>
						<td colspan="3"><input class="input_email" type="email" name="email" placeholder="exemplo@email.com"></td>
					</tr>
					<tr>
						<td>Senha</td>
						<td></td>
						<td>Confirmar senha</td>
					</tr>
					<tr>
						<td><input class="input_sign_up" type="password" name="password" placeholder="********"></td>
						<td></td>
						<td><input class="input_sign_up" type="password" name="password_2" placeholder="********"></td>
					</tr>
				</table>
				<div id="btn_submit">
					<input type="submit" name="sign_up_btn" value="Cadastrar">
				</div>
			</form>
		</div>
	</div>
</body>
</html>