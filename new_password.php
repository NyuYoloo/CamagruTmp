<?php

	include_once 'inc/header.php';
	include_once 'config/database.php';
	include_once 'config/setup.php';
	include_once 'script/modif.php';
	
?>


	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link rel="stylesheet" type="text/css" href="style/connexion.css">
	<link rel="stylesheet" type="text/css" href="style/reset_passwd.css">

	<div class="main-content">
		<div class="menu-left" style="text-align: center;">
			<div><a href="gallery.php"><img class="menu-icons separator" src="img/compass.png"></a></div>
		</div>
		<div class="center-content">
			<div class="global-cell-1">
				<div class="cell-1 title-def">Nouveau Mot de passe</div>
				<div class="cell-2">
					<form method="post">
						<div class="item">Login</div>
						<input type="text" name="login">
						<div class="item">Mail</div>
						<input type="email" name="mail">
						<div class="item">Nouveau mot de passe</div>
						<input type="password" name="new_passwd">
						<br>
						<div class="item">Confirmation nouveau mot de passe</div>
						<input type="password" name="confirm_passwd">
						<br>
						<input type="submit" name="button" value="Confirmer" class="btn-def">
					</form>
				</div>
				<div class="cell-3">
					<a class="btn-def" href="index.php">Back</a>
				</div>
				<div class="cell-4 text-1">
					<?php if (isset($r)) {
						echo $r;
					} ?>
				</div>
			</div>
		</div>
	</div>