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
		<h3 style="text-align: center;">Confirmar exclusão</h3>
		<h4 style="text-align: center;">Deletar Item</h4>
		<?php

			$item_id = $_SESSION['id_item'];
			$sql = "SELECT * FROM itens WHERE id_item = '$item_id'";
			$result = mysqli_query($connect, $sql);
			$inf = mysqli_fetch_assoc($result);
			?>
		<form action="control.php" method="POST">
			<div style="width: 900px; text-align: center;">
				<p>Deseja excluir o item <?php echo $inf['nome'] ?> ?</p>
				<input style="margin-top: 200px;" class="delete_btn" type="submit" name="confirm_delete_item" value="Confirmar exclusão">
				<input type="hidden" name="id_item" value="<?php echo $inf['id_item']; ?>">
			</div>
		</form>

	</div>
</div>
</body>
</html>