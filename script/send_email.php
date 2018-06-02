<?php 

function send_email($mail, $login)
{
	$url = str_replace("reset_password.php", "" , $_SERVER['REQUEST_URI']);
	$url = str_replace("index.php", "" , $url);
	if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
		$passage_ligne = "\r\n";
	else
		$passage_ligne = "\n";
	$message_txt = "Salut à tous, voici un e-mail envoyé par un script PHP.";
	$message_html = "<html><head></head><body><b>Bonjour ".$login.",</b><br/>Vous venez de demander la reinitialisation de vorte mot de passe. <br/>Pour changer votre mot de passe cliquez sur lien suivant: <br/> <a href='http://".$_SERVER['HTTP_HOST']."".$url."change_password.php'>Modification du mot de passe</a></body></html>";
	$boundary = "-----=".md5(rand());
	$sujet = "Modification du mot de passe de votre compte Camagru";
	$header = "From: \"Camagru\"<camagru@42.fr>".$passage_ligne;
	$header.= "Reply-to: \"Camagru\" <camagru@42.fr>".$passage_ligne;
	$header.= "MIME-Version: 1.0".$passage_ligne;
	$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
	$message = $passage_ligne."--".$boundary.$passage_ligne;
	$message.= "Content-Type: text/plain; charset=\"UTF-8\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_txt.$passage_ligne;
	$message.= $passage_ligne."--".$boundary.$passage_ligne;
	$message.= "Content-Type: text/html; charset=\"UTF-8\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_html.$passage_ligne;
	$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
	$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
	mail($mail,$sujet,$message,$header);
}

?>