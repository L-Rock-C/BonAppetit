<?php

session_start();	

include_once "connect.php";
include_once "header.php";

?>
	<div id="home_page">	
		<?php
			include_once 'navbar.php';
		?>
		<div id="page_content" style="width: 800px; text-align: center">
			<div id="page_top">
				<h2>Faça o cadastro do seu Cardápio</h2>
			</div>
			<form id="sign_up_menu_form" action="control.php" method="POST">
				<h3>Selecione o restaurante</h3>
				<div>
					<select class="input_sign_up" name="id_rest">
						<?php
						$user_id = $_SESSION['login'];
						$sql = "SELECT * FROM restaurantes WHERE dono_id = '$user_id'";
						$result = mysqli_query($connect, $sql);

						if(mysqli_num_rows($result)){
							while($inf = mysqli_fetch_assoc($result)){
						?>
						<option value="<?php echo $inf['id_restaurante']; ?>"><?php echo $inf['nome']; ?></option>
						<?php
							}
						}
						?>
					</select>
					<div>
						<input class="input_sign_up" type="text" name="menu_name" placeholder="Nome do cardápio" style="margin-bottom: 40px; width: 290px;">
					</div>
				</div>
				<div id="btn_submit">
					<input type="submit" name="sign_up_menu_btn" value="Cadastrar Cardápio">
				</div>
			</form>
		</div>
	</div>
</body>
</html>