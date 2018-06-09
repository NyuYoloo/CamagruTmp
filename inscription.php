<?php

	session_start();
	include_once 'config/database.php';
	include_once 'config/setup.php';
	include_once 'inc/header.php';

	if (!empty($_POST)) {
		$login = $_POST['login'];
		$password = $_POST['passwd'];
		$cf_password = $_POST['confpw'];
		$mail = $_POST['mail'];
		
		if (empty($_POST['login']) || !preg_match('/^[a-zA-Z0-9]+$/', $_POST['login'])) {
			$ret = 'Votre login n\'est pas valide';
		} 
		else {
			$req = $bdd->prepare('SELECT id FROM `users` WHERE `login` = ?');
			$req->bindParam(1, $login);
			$req->execute();
			$user1 =$req->fetch();
			if ($user1) {
				$ret = 'Ce login est déjà pris';
			} 
		}
		if (empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
			$ret = 'Votre email n\'est pas valide';
		}
		else {
			$req1 = $bdd->prepare('SELECT id FROM `users` WHERE `mail` = ?');
			$req1->bindParam(1, $mail);
			$req1->execute();
			$user1 = $req1->fetch();
			if ($user1) {
				$ret = 'Cet email est déjà utilisé';
			} 	
		}

		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);
		if (!$uppercase || !$lowercase || !$number || strlen($password) < 8 || $password != $cf_password) {
			$ret = 'Vous devez entrer un mot de passe valide (a-z & A-Z & 0-9)';

		}

		if (empty($ret)) {
			$token = md5(microtime(TRUE)*100000);
			$req = $bdd->prepare("INSERT INTO `users` (`login`, `passwd`, `mail`, `token`) VALUES (?, ?, ?, ?)");
			$hash = hash('whirlpool', $password);
			$req->bindParam(1, $login);			
			$req->bindParam(2, $hash);
			$req->bindParam(3, $mail);
			$req->bindParam(4, $token);
			$req->execute();

			// Préparation du mail contenant le lien d'activation
			$destinataire = $mail;
			$sujet = "Activer votre compte " .$login;
			$host = exec("hostname -f");
			// Le lien d'activation est composé du login(log) et de la clé(cle)
			$message = 'Bienvenue sur Camagru,
			 
			Pour activer votre compte, veuillez cliquer sur le lien ci dessous
			ou copier/coller dans votre navigateur internet.
			 
			http://'.$host.':8100/Camagru/script/validation.php?login='.$login.'&token='.$token.'
			 
			 
			---------------
			Ceci est un mail automatique, Merci de ne pas y répondre.';

			// Envoi du mail
			mail($destinataire, $sujet, $message);
		}
	}

?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="style/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/css/mdb.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style/connexion.css">
	<link rel="stylesheet" type="text/css" href="style/style.css">

	<div class="main-content">
		<div class="menu-left" style="text-align: center;">
			<div><a href="gallery.php"><img class="menu-icons separator" src="img/compass.png"></a></div>
		</div>
    	<div class="center-content">
			<div class="connexion-content">
				<div class="top-content title-def">INSCRIPTION</div>
				<div class="left-content">
					<form action="inscription.php" method="post">
	                    <!-- Material input login -->
	                    <div class="md-form">
	                        <i class="fa prefix grey-text"></i>
	                        <input type="text" id="materialFormLoginEx" class="form-control" name="login">
	                        <label for="materialFormLoginEx">Your login</label>
	                    </div>
						<!-- Material input email -->
						<div class="md-form">
	                        <i class="fa prefix grey-text"></i>
	                        <input type="email" id="materialFormLoginEmailEx" class="form-control" name="mail">
	                        <label for="materialFormLoginEmailEx">Your Email</label>
						</div>
	                    <!-- Material input password -->
	                    <div class="md-form">
	                        <i class="fa prefix grey-text"></i>
	                        <input type="password" id="materialFormLoginPasswordEx" class="form-control" name="passwd">
	                        <label for="materialFormLoginPasswordEx">Your password</label>
	                    </div>
	                    <div class="md-form">
	                        <i class="fa prefix grey-text"></i>
	                        <input type="password" id="materialFormLoginPasswordEx2" class="form-control" name="confpw">
	                        <label for="materialFormLoginPasswordEx2">Confirm Your password</label>
	                    </div>

	                    <div class="text-center">
	                        <button class="btn-def" type="submit" name="submit" value="Sign up">Sign up</button>
	                    </div>
		                <?php if ($ret != NULL) { ?>
	                   		<div class="alert alert-warning" style="font-size: 15px">
	                        	<?php echo $ret ?>
	                    	</div>
	                    <?php } 
	                       	if (empty($ret) && $_POST['submit'] === "Sign up") { ?>
                        		<div class="alert alert-success" style="font-size: 15px;">Votre compte a bien été créé. Vous allez recevoir un mail de confirmation.</div>
						<?php } ?>
               		</form>				
				</div>
				<div class="right-content" style="text-align: center;">
					<div class="text-1">Rejoins la communauté Camagru ! </div>
                	<div class="text-2">Créer un compte CAMAGRU est simple, rapide, et vous garantit qu'un paquet de chocapic vous sera livré le lendemain.</div>
				</div>
			</div>
    	</div>
	</div>
<script type="text/javascript" src="js/function.js"></script>