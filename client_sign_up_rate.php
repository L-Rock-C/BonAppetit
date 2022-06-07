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
						<td width="33%"></td>
						<td>Nota (1 a 5)</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td><input class="input_sign_up" type="number" name="rate_note" value="5" min="1" max="5"></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="3">Descrição</td>
					</tr>
					<tr>
						<td colspan="3"><textarea class="input_sign_up" name="rate_descri"></textarea></td>
					</tr>
				</table>
				<input type="hidden" name="rest_id" value="<?php echo $_SESSION['restaurant_id']; ?>">
				<div id="btn_submit">
					<input type="submit" name="sign_up_rate_btn" value="Inserir Avaliação">
				</div>
			</form>
		</div>
	</div>
</body>
</html>