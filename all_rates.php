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
		<h3 style="text-align: center;">Avaliações</h3>
		<h4 style="text-align: center;">Todas as avaliações</h4>
		<!-- --------- LIST RESTAURANTS ----------- -->
		<?php

		$user_id = $_SESSION['login'];
		$rest_id = $_SESSION['restaurant_id'];
		$sql = "SELECT * FROM avaliacoes";
		$result = mysqli_query($connect, $sql);


		if(mysqli_num_rows($result)){
			while($line = mysqli_fetch_assoc($result)){
		?>
		<form action="control.php" method="POST">
			<div class="rest_list">
				<div class="rest_line" style="height: unset; min-height: 50px;">
					<div style="display: flex; justify-content: space-between; margin-top: 5px;">	
						<?php
						$user_rate_id = $line['user_id'];
						$sql1 = "SELECT * FROM usuarios WHERE user_id = '$user_rate_id'";
						$result1 = mysqli_query($connect, $sql1);
						$inf = mysqli_fetch_assoc($result1);
						?>
						<div style="width: 200px; margin-left: 40px; font-weight: bold;"><?php echo $inf['user_name']; ?></b></div>
						<div style="width: 100px"><b><?php echo $line['rate_note']; ?>/5</b></div><br>
						<div style="width: 360px;"><?php echo $line['rate_descri']; ?></div>
						<div><?php echo $line['rate_date']; ?></div>
					</div>
					<input type="hidden" name="rest_id" value="<?php echo $_SESSION['restaurant_id']; ?>">
				</div>
				<div class="table_space"></div>
			</div>
		</form>
		<?php
			}
		}
		?>
		<?php  
		$sql = "SELECT user_type FROM usuarios WHERE user_id = '$user_id'";
		$result = mysqli_query($connect, $sql);
		$inf = mysqli_fetch_assoc($result);
		if($inf['user_type'] == true){
		?>
		<form action="control.php" method="POST">
			<div id="btn_submit" style="width: 800px; text-align: center; margin-top: 50px;">
				<input type="submit" name="sign_up_rate" value="Avaliar Restaurante">
				<input type="hidden" name="rest_id" value="<?php echo $_SESSION['restaurant_id']; ?>">
			</div>
		</form>	
		<?php
		}
		?>
		
	</div>
</div>
</body>
</html>