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
		<h3 style="text-align: center;">Página Inicial</h3>
		<h4 style="text-align: center;">Meus cardápios</h4>
		<!-- --------- LIST RESTAURANTS ----------- -->
		<?php

		$rest_id = $_SESSION['restaurant_id'];
		$sql = "SELECT * FROM cardapio WHERE id_rest = '$rest_id'";
		$result = mysqli_query($connect, $sql);

		if(mysqli_num_rows($result)){
			while($line = mysqli_fetch_assoc($result)){
		?>
		<form action="control.php" method="POST">
			<div class="rest_list">
				<div class="rest_line">
					<div style="width: 500px; margin-left: 15px; font-weight: bold;">
						<?php 
							echo $line['nome']
						?>
						</b></div>
					<div><input class="green_btn" type="submit" name="view_itens_menu" value="Visualizar"></div>
					<div style="margin-right: 15px;"><input class="green_btn" type="submit" name="gerenciar_menu" value="Gerenciar"></div>
					<input type="hidden" name="card_id" value="<?php echo $line['id']; ?>">
				</div>
				<div class="table_space"></div>
			</div>
		</form>
		<?php
			}
		} else{
		?>
		<form action="control.php" method="POST" style="width: 800px; margin-top: 200px;">
			<div id="btn_submit">
				<input type="submit" name="sign_up_menu_page" value="Adicionar Cardápio">
			</div>
		</form>
		<?php
		}
		?>
	</div>
</div>
</body>
</html>