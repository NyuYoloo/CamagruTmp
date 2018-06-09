<?php 

function send_email($mail, $login)
{
			$destinataire = $mail;
			$sujet = "Modification de votre mot de passe" .$login;
			$host = exec("hostname -f");
			$message = 'Bonjour,
			 
			Vous venez de demander la reinitialisation de vorte mot de passe.
			Pour changer votre mot de passe cliquez sur lien suivant: 
			 
			http://'.$host.':8100/Camagru/new_password.php
			 
			 
			---------------
			Ceci est un mail automatique, Merci de ne pas y répondre.';

			// Envoi du mail
			mail($destinataire, $sujet, $message);
}

?>