<?php
	session_start();

	include_once "header.php";
?>

	<div id="home_page">
		<div class="sign_up">
			<div class="sign_up_img">
				<img id="sign_up_img" src="images/log_in_img.png">
			</div>
			<div class="sign_up_txt">
				<p>Encontre um<br>restaurante de<br>maneira simples.</p>
			</div>
			<div class="sign_up_btn">
				<a href="signup.php"><input type="button" id="sign_up_btn" value="Crie sua conta"></a>
			</div>
		</div>
		<div class="log_in">
			<form id="log_in_form" action="control.php" method="POST">
				<h3>Entre com seu<br>email e senha</h3>
				<input type="email" name="email" placeholder="exemplo@email.com">
				<input type="password" name="password" placeholder="********">
				<input type="submit" name="log_in_btn" value="Entrar">
				<a href="signup.php">Esqueceu a senha?</a>
			</form>
		</div>
	</div>
</body>
</html>