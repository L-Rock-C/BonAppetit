<?php 

$user_id = $_SESSION['login'];
$sql = "SELECT user_type FROM usuarios WHERE user_id = '$user_id'";
$result = mysqli_query($connect, $sql);
$inf = mysqli_fetch_assoc($result);


if($inf['user_type']){
?>

<div id="left_bar">
	<input type="button" name="back_btn" id="back_btn" onclick="history.go(-1)">
	<nav id="nav_menu">
		<ul id="nav_menu">
			<li><a class="menu_item" href="home_client.php">Página Inicial</a></li>
			<li><a class="menu_item" href="adm/adm_rate.php">Avaliações</a></li>
			<li><a class="menu_item" href="profile.php">Perfil</a></li>
			<li><a class="menu_item" href="index.php">Sair</a></li>
		</ul>
	</nav>
</div>
<?php
} else{
?>
<div id="left_bar">
	<input type="button" name="back_btn" id="back_btn" onclick="history.go(-1)">
	<nav id="nav_menu">
		<ul id="nav_menu">
			<li><a class="menu_item" href="home_adm.php">Página Inicial</a></li>
			<li><a class="menu_item" href="adm/adm_rate.php">Avaliações</a></li>
			<li><a class="menu_item" href="adm_sign_up_rest.php">Cadastrar Restaurante</a></li>
			<li><a class="menu_item" href="adm/sign_up_menu.php">Cadastrar Cardápio</a></li>
			<li><a class="menu_item" href="profile.php">Perfil</a></li>
			<li><a class="menu_item" href="index.php">Sair</a></li>
		</ul>
	</nav>
</div>
<?php
}
?>