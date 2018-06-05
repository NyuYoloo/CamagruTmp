<?php
	
	// if (isset($_POST['button']) == "Save")
	// {
	// 	try {
	// 		$req_user = $bdd->prepare("SELECT login FROM users where")
	// 	}
	// 	if ($_POST['login'] == $_SESSION['login'])
	// 	{

	// 	}
	// }

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
                $ret = 'Votre mot de passe ne correspond pas';
            }
        }
        else {
            $ret = 'Votre Email n\'est pas valide';
        }
    }

	if (isset($_POST['button']) == "Change password")
	{
		if (!empty($_POST['login']) AND !empty($_POST['old_passwd']) AND !empty($_POST['new_passwd']) AND !empty($_POST['confirm_passwd']))
		{
			$login = htmlentities($_POST['login']);
			$oldpassword = hash('whirlpool', ($_POST['old_passwd']));
			$newpassword = hash('whirlpool', ($_POST['new_passwd']));
			$conf = hash('whirlpool', ($_POST['confirm_passwd']));
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

