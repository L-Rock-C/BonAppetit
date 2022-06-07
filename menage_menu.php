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

			$id_cardapio = $_SESSION['id_cardapio'];
			$sql = "SELECT DISTINCT categoria FROM itens WHERE id_cardapio = '$id_cardapio'";
			$result = mysqli_query($connect, $sql);

			if(mysqli_num_rows($result)){
				while($line = mysqli_fetch_assoc($result)){
			?>
			<div id="categ_menu">
				<input type="hidden" name="id_cardapio" value="<?php echo $id_cardapio; ?>">
				<input class="input_categ" type="text" name="categ" placeholder="Categoria" value="<?php echo $line['categoria']; ?>"><br>
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
						<input class="input_item" type="text" name="item" placeholder="Item" value="<?php echo $line2['nome']; ?>" style="text-align: right;">
						<p style="color: #2A5C0B">____________________________________________</p>
						<input class="input_item" type="text" name="valor" placeholder="00.00" value="<?php echo $line2['preco']; ?>"><br>
					</div>
					<div class="ingred">
						<textarea class="input_ingred" name="ingred" placeholder="Ingredientes"><?php echo $line2['ingredientes']; ?></textarea>
						<input class="btn_delete" type="submit" name="delete_item_btn" value="X">
						<input type="hidden" name="id_item" value="<?php echo $line2['id_item']; ?>">
					</div>
				</div>
			</form>
					<?php
						}
					}
					?>
			<?php
				}
			}
			?>
			<form action="control.php" method="POST">
				<input type="hidden" name="id_cardapio" value="<?php echo $id_cardapio; ?>">
				<div class="menu_categ">
					<input class="input_categ" type="text" name="categ" placeholder="Categoria"><br>
					<div class="item_preco">
						<input class="input_item" type="text" name="item" placeholder="Item" style="text-align: right;">
						<p style="color: #2A5C0B">____________________________________________</p>
						<input class="input_item" type="text" name="valor" placeholder="00.00"><br>
					</div>
					<div class="ingred">
						<textarea class="input_ingred" name="ingred" placeholder="Ingredientes"></textarea>
					</div>
				</div>
				<div id="btn_submit">
					<input class="submit_btn" type="submit" name="sign_up_item" value="Adicionar Item">
					<input class="submit_btn" type="submit" name="delete_menu" value="Excluir Cardápio">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>