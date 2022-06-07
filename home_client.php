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
		<h4 style="text-align: center;">Todos os restaurantes</h4>
		<!-- --------- LIST RESTAURANTS ----------- -->
		<?php

		$dono_id = $_SESSION['login'];
		$sql = "SELECT * FROM restaurantes";
		$result = mysqli_query($connect, $sql);

		if(mysqli_num_rows($result)){
			while($line = mysqli_fetch_assoc($result)){
		?>
		<form action="control.php" method="POST">
			<div class="rest_list">
				<div class="rest_line">
					<div style="width: 360px; margin-left: 15px; font-weight: bold;
						<?php 
						if(!$line['funcionando']){
							?>
							color: red;">
							<?php
							echo $line['nome'];
						} else{
							echo '">'.$line['nome'];
						}
						
						?>
						</b></div>
					<div>Estrelas</div>
					<div><input class="green_btn" type="submit" name="view_rates" value="Avaliações"></div>
					<div><input  style="margin-right: 15px;" class="green_btn" type="submit" name="client_view_menu" value="Cardápios"></div>
					<input type="hidden" name="rest_id" value="<?php echo $line['id_restaurante']; ?>">
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