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
		<h3 style="text-align: center;">Bon Appétit</h3>
		<h4 style="text-align: center;">Gerenciar cardápio</h4>
		<!-- --------- LIST RESTAURANTS ----------- -->

		<div id="menu_content">
			<?php

			$id_cardapio = $_SESSION['id_card'];
			$sql = "SELECT DISTINCT categoria FROM itens WHERE id_cardapio = '$id_cardapio'";
			$result = mysqli_query($connect, $sql);

			if(mysqli_num_rows($result)){
				while($line = mysqli_fetch_assoc($result)){
			?>
			<div id="categ_menu">
				<input type="hidden" name="id_cardapio" value="<?php echo $id_cardapio; ?>">
				<p class="input_categ" type="text" name="categ" placeholder="Categoria"><?php echo $line['categoria']; ?></p>
			</div>
					<?php
					$id_cardapio2 = $_SESSION['id_cardapio'];
					$categoria = $line['categoria'];
					$sql2 = "SELECT * FROM itens WHERE categoria = '$categoria' AND id_cardapio = '$id_cardapio2'";
					$result2 = mysqli_query($connect, $sql2);

					if(mysqli_num_rows($result2)){
						while($line2 = mysqli_fetch_assoc($result2)){
					?>
			<form action="control.php" method="POST">
				<div class="menu_categ">
					<div class="item_preco">
						<p class="input_item" type="text" name="item" placeholder="Item" value="" style="text-align: right;"><?php echo $line2['nome']; ?></p>
						<p style="color: #2A5C0B">____________________________________________</p>
						<p class="input_item" type="text" name="valor" placeholder="00.00" value=""><?php echo $line2['preco']; ?></p>
					</div>
					<div class="ingred">
						<textarea class="input_ingred" disabled name="ingred" placeholder="Ingredientes"><?php echo $line2['ingredientes']; ?></textarea>
						<input type="hidden" name="id_item" value="<?php echo $line2['id_item']; ?>">
					</div>
				</div>
			</form>
					<?php
						}
					}
				}
			}
			?>
		</div>
	</div>
</div>
</body>
</html>