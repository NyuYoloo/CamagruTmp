<?php

	session_start();

	if (isset($_SESSION['login']) != NULL) {
		header('Location: profil.php');
	}

	include_once 'inc/header.php';
  	include_once 'config/setup.php';

    if(!(empty($_POST) && empty($_POST['login']) && empty($_POST['passwd']))) {

        $req = $bdd->prepare('SELECT * FROM users WHERE (login = :login)');
        $req->execute(['login' => $_POST['login']]);
        $user = $req->fetch();
        if($user == null){
            $ret = 'Identifiant ou mot de passe incorrecte';
        }
        else if(hash('whirlpool', $_POST['passwd']) === $user['passwd'] && $user['token'] == 1){
            $_SESSION['login'] = $user['login'];
            $_SESSION['mail'] = $user['mail'];
            $_SESSION['id'] = $user['id'];
            header('Location: profil.php');
            exit();
        }
        else{
            $ret = 'Identifiant ou mot de passe incorrecte';
        }
    }

?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="style/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/css/mdb.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link rel="stylesheet" type="text/css" href="style/connexion.css">

	<div class="main-content">
		<div class="menu-left" style="text-align: center;">
			<div><a href="gallery.php"><img class="menu-icons separator" src="img/compass.png"></a></div>
		</div>
		<div class="center-content">
			<div class="connexion-content">
				<div class="top-content title-def">CONNEXION</div>
				<div class="left-content" style="text-align: center;">
					<form action="connexion.php" method="post">
                    	<!-- Material input email -->
	                    <div class="form-content md-form">
	                        <i class="fa prefix grey-text"></i>
	                        <input type="text" id="materialFormLogin" class="form-control" name="login">
	                        <label for="materialFormLogin">Your login</label>
	                    </div>

	                    <!-- Material input password -->
	                    <div class="form-content md-form">
	                        <i class="fa prefix grey-text"></i>
	                        <input type="password" id="materialFormPassword" class="form-control" name="passwd">
	                        <label for="materialFormPassword">Your password</label>
	                    </div>

	                    <div style="text-align: center">
	                        <button class="btn-def" type="submit">Login</button>
	                    </div>
	                    <div><a style="font-size: 17px; color: white;" href="reset_passwd.php">Mot de passe oublié</a></div>
	                </form>
	                <?php if ($ret != NULL) { ?>
                   		<div class="alert alert-warning" style="font-size: 15px">
                        	<?php echo $ret ?>
                    	</div>
                    <?php } ?>
               		 <!-- Material form login -->
				</div>
				<div class="right-content" style="text-align: center">
					<div class="text-1">Rejoins la communauté Camagru ! </div>
                	<div class="text-2">Créer un compte CAMAGRU est simple, rapide, et vous garantit qu'un paquet de chocapic vous sera livré le lendemain.</div>
<!--                 	<div class="btn-def"><a style="color: white;" href="inscription.php">Inscription</a></div> -->
					<button class="btn-def"><a style="color: white" href="inscription.php">Inscription</a></button>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript" src="js/function.js"></script>
