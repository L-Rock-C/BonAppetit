<?php

session_start();

include_once "connect.php";
include_once "header.php";

$id_rest = $_SESSION['restaurant_id'];
$sql = "SELECT * FROM restaurantes WHERE id_restaurante = '$id_rest'";
$result = mysqli_query($connect, $sql);   
$inf = mysqli_fetch_assoc($result);   

?>
<div id="home_page">
	<?php
	include_once 'navbar.php';
	?>
	<div id="page_content">
		<div id="page_top">
			<h2>Gerencie seu Restaurante</h2>
		</div>
		<?php
		$id_rest = $_SESSION['restaurant_id'];
		$sql = "SELECT * FROM restaurantes WHERE id_restaurante = '$id_rest'";
		$result = mysqli_query($connect, $sql);   
		$inf = mysqli_fetch_assoc($result);   
		?>
		<form id="sign_up_form" action="control.php" method="POST">
			<table id="sign_up_table">
				<tr>
					<td>Nome</td>
					<td>Hora de abertura</td>
					<td>Hora de encerramento</td>
				</tr>
				<input type="hidden" name="rest_id" value="<?php echo $inf['id_restaurante']; ?>">
				<tr>
					<td><input class="input_sign_up" type="text" name="rest_nome" placeholder="Bon Appétit" value="<?php echo $inf['nome']; ?>"></td>
					<td><input class="input_sign_up" type="time" name="time_open" placeholder="07:00" value="<?php echo $inf['hora_ini']; ?>"></td>
					<td><input class="input_sign_up" type="time" name="time_close" placeholder="22:00" value="<?php echo $inf['hora_fim']; ?>"></td>
				</tr>
				<tr>
					<td>Endereço</td>
					<td>Cidade</td>
					<td>UF</td>
				</tr>
				<tr>
					<td><input class="input_sign_up" type="text" name="street" placeholder="Avenida Alberto Maranhão, 25" value="<?php echo $inf['rua']; ?>"></td>
					<td><input class="input_sign_up" type="text" name="city" placeholder="Mossoró" value="<?php echo $inf['cidade']; ?>"></td>
					<td><input class="input_sign_up" type="text" name="state" placeholder="RN" value="<?php echo $inf['estado']; ?>"></td>
				</tr>
				<tr>
					<td>CEP</td>
					<td>Funcionando</td>
					<td></td>
				</tr>
				<tr>
					<td><input class="input_sign_up" type="text" name="cep" placeholder="00000-000" value="<?php echo $inf['cep']; ?>"></td>
					<td>
						<select class="input_sign_up" style="height: 54px; width: 324px;" name="func">
							<option value="0">Não</option>
							<option value="1" selected>Sim</option>
						</select>
					</td>
					<td><input class="delete_btn" type="submit" name="delete_rest_btn" value="Excluir Restaurante"></td>
				</tr>
			</table>
			<div id="btn_submit">
				<input type="submit" name="update_rest_btn" value="Atualizar Restaurante">
			</div>
		</form>
	</div>
</div>	
</body>
</html>