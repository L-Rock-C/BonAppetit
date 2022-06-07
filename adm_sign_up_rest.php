<?php

session_start();	

include_once "connect.php";
include_once "header.php";

?>
	<div id="home_page">	
		<?php
			include_once 'navbar.php';
		?>
		<div id="page_content">
			<div id="page_top">
				<h2>Faça o cadastro do seu Restaurante</h2>
			</div>
			<form id="sign_up_form" action="control.php" method="POST">
				<table id="sign_up_table">
					<tr>
						<td>Nome</td>
						<td>Hora de abertura</td>
						<td>Hora de encerramento</td>
					</tr>
					<tr>
						<td><input class="input_sign_up" type="text" name="rest_nome" placeholder="Bon Appétit"></td>
						<td><input class="input_sign_up" type="time" name="time_open" placeholder="07:00"></td>
						<td><input class="input_sign_up" type="time" name="time_close" placeholder="22:00"></td>
					</tr>
					<tr>
						<td>Endereço</td>
						<td>Cidade</td>
						<td>UF</td>
					</tr>
					<tr>
						<td><input class="input_sign_up" type="text" name="street" placeholder="Avenida Alberto Maranhão, 25"></td>
						<td><input class="input_sign_up" type="text" name="city" placeholder="Mossoró"></td>
						<td><input class="input_sign_up" type="text" name="state" placeholder="RN"></td>
					</tr>
					<tr>
						<td>Senha</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td><input class="input_sign_up" type="text" name="cep" placeholder="00000-000"></td>
						<td></td>
						<td></td>
					</tr>
				</table>
				<div id="btn_submit">
					<input type="submit" name="sign_up_rest_btn" value="Cadastrar Restaurante">
				</div>
			</form>
		</div>
	</div>
</body>
</html>