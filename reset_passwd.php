<?php

	session_start();

	include_once 'inc/header.php';
	include_once 'config/database.php';
  	include_once 'config/setup.php';
  	include_once 'script/send_email.php';

	if ($_POST['button'] == "Send mail")
	{
		if (!empty($_POST['login']) AND !empty($_POST['mail']))
		{
			$login = htmlentities($_POST['login']);
			$mail = htmlentities($_POST['mail']);
			try {
				$req_user = $bdd->prepare("SELECT * FROM users WHERE login= ?");
				$req_user->execute(array($login));
				$user_info = $req_user->fetch();
				$user_check = $req_user->rowCount();
			}
			catch (PDOexception $e) {
				print "Erreur : ".$e->getMessage()."";
				die();
			}
			if ($user_check == 1)
			{
				if ($mail == $user_info['mail'])
					{
						send_email($mail, $login);
						$ret = "An email has been send to reset your password";
					} else {$ret = "This email doesn't match your email";}
			} else {$ret = "This login doesn't exist";}
		} else {$ret = "Please Type all the areas";}
	}
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
				<div class="cell-1 title-def">Mot de passe oublié</div>
				<div class="cell-2">
					<form method="post">
						<div class="item">Login</div>
						<input type="text" name="login">
						<br>
						<div class="item">Email</div>
						<input type="email" name="mail">
						<br>
						<input type="submit" name="button" value="Send mail" class="btn-def">
					</form>
				</div>
				<div class="cell-3">
					<a class="btn-def" href="index.php">Back</a>
				</div>
				<div class="cell-4 text-1">
					<?php if (isset($ret)) {
						echo $ret;
					} ?>
				</div>
			</div>
		</div>
	</div>