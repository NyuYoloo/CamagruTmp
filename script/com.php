<?php 
set_include_path('../');
include_once 'inc/security.php';
include_once 'config/database.php';
include_once 'config/setup.php';

if (isset($_POST['comment']))
{
    $txt = htmlspecialchars($_POST['comment']);
    if (strlen($txt) < 75 && strlen($txt) > 1) {
        try {
            $r = $bdd->prepare("INSERT INTO comments (img_id, date_creation, txt) VALUES (:img_id, NOW(), :txt)");
            $r->bindParam(":img_id", $_SESSION['id_img']);
            $r->bindParam(":txt", $txt);
            $r->execute();
        }
        catch(PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
        try {
            $r = $bdd->prepare("SELECT id FROM imgs WHERE id_post =  :id");
            $r->execute(array('id' => $_SESSION['id_img']));
            $res = $r->fetchAll();
        }
        catch(PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
        try {
            $r = $bdd->prepare("SELECT * FROM users WHERE id =  :id");
            $r->execute(array('id' => $res[0]['id']));
            $res = $r->fetchAll();
        }
        catch(PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
        // if ($res[0]['notif'] === '1') {
            $destinataire = $res[0]['mail'];
            $sujet = "Nouveau commentaire ";
            $host = exec("hostname -f");
            $message = 'Bienvenue sur Camagru,
            
            Vosu avez un nouveau com sur une image.
            
            http://'.$host.':8100/Camagru/picture.php?id='.$_SESSION['id_img'].'
            
            
            ---------------
            Ceci est un mail automatique, Merci de ne pas y répondre.';

            // Envoi du mail
            $sent = mail($destinataire, $sujet, $message);
                if ($sent === true)
                    echo $txt;
        }
        else {
            echo $txt;
        }
    // }
}

?>
