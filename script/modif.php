<?php
	
	include_once 'config/database.php';
	include_once 'config/setup.php';

	if (isset($_GET['submit']) == "Save Login")
	{
		if (!empty($_GET['login']) && !empty($_GET['new_login']))
		{
			if ($_GET['login'] == $_SESSION['login'])
			{
				$login = htmlspecialchars($_GET['login']);
				$new_log = htmlspecialchars($_GET['new_login']);
				$change_log = $bdd->prepare("UPDATE users SET login = :new WHERE (login = :login)");
				$change_log->execute(array("new" => $new_log, "login" => $login));
				$rets = "Votre login a ete modifié";
			}
			else{$rets = "This login doesn't exist";}
		} else {$rets = "Please type all the areas";}
	}	

    if (isset($_GET['button']) == "Delete Account")
    {
        if ($_GET['confirm-email'] == $_SESSION['mail'])
        {
            $passwd = hash("whirlpool", $_GET['passwd']);
            $mail = $_GET['confirm-email'];
            try {
                $check_pw = $bdd->prepare("SELECT passwd FROM users WHERE mail = ?");
                $check_pw->execute(array($_SESSION['mail']));
                $verif = $check_pw->fetch();
            }
            catch (PDOexception $e) {
                print "Erreur : ".$e->getMessage()."";
                die();
            }
            if ($verif['passwd'] === $passwd) {
                try {
                    $req_delete_account = $bdd->prepare("DELETE FROM users WHERE mail = ?");
                    $req_delete_account->execute(array($_SESSION['mail']));

                    $req_delete_img = $bdd->prepare("DELETE FROM imgs WHERE id = ?");
                    $req_delete_img->execute(array($_SESSION['id']));

                    $req_delete_like = $bdd->prepare("DELETE FROM likes WHERE id = ?");
                    $req_delete_like->execute(array($_SESSION['id']));

                    $req_delete_com = $bdd->prepare("DELETE FROM comments WHERE id = ?");
                    $req_delete_com->execute(array($_SESSION['id']));

                    $ret =  '<div>Account deleted</div>';
                    $_SESSION['login'] = null;
                    ?>
                    <meta http-equiv="refresh" content="3; url=index.php">
                <?php } 
                catch (PDOexception $e) {
                    print "Erreur : ".$e->getMessage()."";
                    die();
                }
            }
            else {
                $re = 'Votre mot de passe ne correspond pas';
            }
        }
        else {
            $re = 'Votre Email n\'est pas valide';
        }
    }

	if (isset($_POST['button']) == "Change password")
	{
		if (!empty($_POST['login']) AND !empty($_POST['old_passwd']) AND !empty($_POST['new_passwd']) AND !empty($_POST['confirm_passwd']))
		{
			$login = htmlentities($_POST['login']);
			$oldpassword = hash('whirlpool', ($_POST['old_passwd']));
			$newpassword = hash('whirlpool', htmlspecialchars($_POST['new_passwd']));
			$conf = hash('whirlpool', htmlspecialchars($_POST['confirm_passwd']));
			try {
				$req_user = $bdd->prepare("SELECT * FROM users WHERE id= ?");
			$req_user->execute(array($_SESSION['id']));
			$user_info = $req_user->fetch();
			}
			catch (PDOexception $e) {
				print "Erreur : ".$e->getMessage()."";
				die();
			}
			if ($login == $_SESSION['login'])
			{
				if ($oldpassword == $user_info['passwd'])
				{
					if ($newpassword == $conf)
					{
						if (testpassword($_POST['confirm_passwd'])) {
							try{
								$insert_new_passwwd = $bdd->prepare("UPDATE users SET passwd = ? WHERE id = ?");
								$insert_new_passwwd->execute(array($conf, $_SESSION['id']));
								$ret = "Password updated";
							}
			catch (PDOexception $e) {
				print "Erreur : ".$e->getMessage()."";
				die();
			}
						} else {$ret = "Password is too weak";}
					} else {$ret = "Your new password doesn 't match with the confirm one";}
				} else {$ret = $oldpassword ;}
			} else {$ret = "This login doesn't exist";}
		} else {$ret = "Please type all the areas";}
	}

	if ($_POST['button'] == "Confirmer")
	{
		if (!empty($_POST['login'])  AND !empty($_POST['mail']) AND !empty($_POST['new_passwd']) AND !empty($_POST['confirm_passwd']))
		{
			$login = htmlentities($_POST['login']);
			$email = htmlentities($_POST['mail']);
			$newpassword = hash('whirlpool', htmlspecialchars($_POST['new_passwd']));
			$conf = hash('whirlpool', htmlspecialchars($_POST['confirm_passwd']));
			try {
				$req_user = $bdd->prepare("SELECT * FROM users WHERE login= ? AND mail = ?");
				$req_user->execute(array($login, $email));
				$user_info = $req_user->rowCount();
			}
			catch (PDOexception $e) {
				print "Erreur : ".$e->getMessage()."";
				die();
			}
			if ($user_info)
			{
					if ($newpassword == $conf)
					{
						if (testpassword($_POST['confirm_passwd'])) {
							try {
								$insert_new_passwwd = $bdd->prepare("UPDATE users SET passwd = ? WHERE login = ?");
								$insert_new_passwwd->execute(array($conf, $login));
								$r = "Password updated";
							}
									catch (PDOexception $e) {
				print "Erreur : ".$e->getMessage()."";
				die();
			}
						}		else {$r = "Password is too weak";}
					} else {$r = "Your new password doesn 't match with the confirm one";}
				} else {$r = "Incorrect login or email";}
		} else {$r = "Please type all the areas";}
	}

	function testpassword($mdp)	
	{
	$longueur = strlen($mdp);
	if ($longueur >= 5) {
		for($i = 0; $i < $longueur; $i++) 	{
			$lettre = $mdp[$i];
			if ($lettre>='a' && $lettre<='z'){
				$point = $point + 1;
				$point_min = 1;
			}
			else if ($lettre>='A' && $lettre <='Z'){
				$point = $point + 2;
				$point_maj = 2;
			}
			else if ($lettre>='0' && $lettre<='9'){
				$point = $point + 3;
				$point_chiffre = 3;
			}
			else {
				$point = $point + 5;
				$point_caracteres = 5;
			}
		}
	}
	else 
		return (0);
	$etape1 = $point / $longueur;
	$etape2 = $point_min + $point_maj + $point_chiffre + $point_caracteres;
	$resultat = $etape1 * $etape2;
	$final = $resultat * $longueur;
	if ($final >= 50)
		return (1);
	else
		return (0);
	}

?>

