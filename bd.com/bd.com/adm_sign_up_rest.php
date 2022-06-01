<?php

include_once "header.php";

?>
	<div id="home_page">	
		<div id="left_bar">
			<div id="left_bar">
				<input type="button" name="back_btn" id="back_btn" onclick="history.go(-1)">
			</div>
			<nav id="nav_menu">
				<ul id="nav_menu">
					<li><a class="menu_item" href="home_adm.php">Página Inicial</a></li>
					<li><a class="menu_item" href="adm/adm_rate.php">Avaliações</a></li>
					<li><a class="menu_item" href="adm_sign_up_rest.php">Cadastrar Restaurante</a></li>
					<li><a class="menu_item" href="adm/sign_up_menu.php">Cadastrar Cardápio</a></li>
					<li><a class="menu_item" href="index.php">Sair</a></li>
				</ul>
			</nav>
		</div>
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