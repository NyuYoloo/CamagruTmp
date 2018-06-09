<?php

	include_once "../config/database.php"; 
	include_once "../config/setup.php"; 
	
?>
	
	<meta http-equiv="refresh" content="5; url=../index.php">
	
<?php

	$login = $_GET['login'];
	$token = $_GET['token'];

	$req = $bdd->prepare("SELECT * FROM users WHERE token = :token");
	$req->execute(array('token' => $token));
	$row = $req->fetch();

	if ($row['login'] === $login) {

	    echo "Votre compte a bien été activé !";
	 
	    $req = $bdd->prepare("UPDATE users SET token = 1 WHERE login = :login ");
	    $req->execute(array('login' => $login));
	}

	else {
		echo "Erreur ! Votre compte ne peut être activé...";
	}

?>