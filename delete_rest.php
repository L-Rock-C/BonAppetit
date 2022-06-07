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
		<h4 style="text-align: center;">Deletar Restaurante</h4>
		<?php

			$rest_id = $_SESSION['restaurant_id'];
			$sql = "SELECT * FROM restaurantes WHERE id_restaurante = '$rest_id'";
			$result = mysqli_query($connect, $sql);
			$inf = mysqli_fetch_assoc($result);
			?>
		<form action="control.php" method="POST">
			<div style="width: 900px; text-align: center;">
				<p>Deseja deletar o restaurante <?php echo $inf['nome'] ?> ?</p>
				<input style="margin-top: 200px;" class="delete_btn" type="submit" name="confirm_delete_rest" value="Confirmar exclusão">
				<input type="hidden" name="id_rest" value="<?php echo $inf['id_restaurante']; ?>">
			</div>
		</form>

	</div>
</div>
</body>
</html>