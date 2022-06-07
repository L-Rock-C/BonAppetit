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
		<h3 style="text-align: center;">Selecione um cardápio</h3>
		<h4 style="text-align: center;">Todos os cardápios</h4>
		<!-- --------- LIST RESTAURANTS ----------- -->
		<?php

		$id_rest = $_SESSION['id_rest'];
		$sql = "SELECT * FROM cardapio WHERE id_rest = '$id_rest'";
		$result = mysqli_query($connect, $sql);

		if(mysqli_num_rows($result)){
			while($line = mysqli_fetch_assoc($result)){
		?>
		<form action="control.php" method="POST">
			<div class="rest_list">
				<div class="rest_line">
					<div style="width: 360px; margin-left: 15px; font-weight: bold;"><?php echo $line['nome']; ?></b></div>
					<div><input style="margin-right: 40px" class="green_btn" type="submit" name="view_itens_menu" value="Visualizar"></div>
					<input type="hidden" name="card_id" value="<?php echo $line['id']; ?>">
				</div>
				<div class="table_space"></div>
			</div>
		</form>
		<?php
			}
		}
		?>
	</div>
</div>
</body>
</html>