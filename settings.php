<?php

    include_once 'inc/security.php';
    include_once 'config/setup.php';
    include_once 'inc/header.php';


    $error = array();
    if (empty($_POST['passwd']) || empty($_POST['cf_password']) || !(empty($_POST['passwd']) != $_POST['cf_password'])) {
        $error = "Les mots de passes ne correspondent pas.";
    }
    else {
        $user_id = $_SESSION['login']->id_user;
        $password = hash('whirlpool', $_POST['passwd']);
        $req = $bdd->prepare('UPDATE users SET passwd = ?');
        $req->execute([$password]);
    }

    if ($_GET['button'] == "Delete Account")
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

    if ($_GET['submit'] == 'Save Changes') {

      

    }
?>

<?php

  if(isset($_POST['upload_file']))
  {
      if ($_FILES['upload_file']['error'] <= 2097152) {

        $users = $_SESSION['login'];
        mkdir('users', 0777, true);
        $paths = "users/";
        mkdir($paths . $users, 0777, true);
        $path = "users/$users/";
        $temp = explode(".", $_FILES['file']['name']);
        $newfilename = str_replace($temp, 'name', "avatar");
        move_uploaded_file($_FILES['photo']['tmp_name'], $path . $newfilename);
        $image = "users/$users/avatar";
      }
  } 
?>

  <link rel="stylesheet" type="text/css" href="style/style.css">
  <link rel="stylesheet" type="text/css" href="style/settings.css">


<div class="main-content">
  <div class="menu-left" style="text-align: center;">
    <div>
      <div><a href="gallery.php"><img class="menu-icons separator" src="img/compass.png"></a></div>
      <?php if ($_SESSION['login'] != NULL) { ?>
        <div><a href="camera.php"><img class="menu-icons separator" src="img/photo.png"></a></div>
        <div><a href="profil.php"><img class="menu-icons separator" src="img/avatar.png"></a></div>
    </div>
    <div>
      <div><a href="settings.php"><img class="menu-icons-bottom separator" src="img/settings.png"></a></div>
      <div><a href="script/logout.php"><img class="menu-icons-bottom separator" src="img/shutdown.png"></a></div>
    </div>
    <?php } ?>
  </div>
  <div class="center-content display" style="text-align: center">
    <div class="global-cell-1">
      <div class="title-def cell-1">Delete Account</div>
      <div class="cell-2">
        <form method="GET">
          <div class="item-def">Email</div>
          <input type="email" name="confirm-email">
          <br>
          <div class="item-def">Password</div>
          <input type="password" name="passwd">
          <br>
          <input type="submit" name="button" value="Delete Account" class="btn-def">
        </form>
      </div>
    </div>
    <div class="global-cell-1">
      <div class="title-def cell-1">Change Password</div>
      <div class="cell-2">
        <form method="POST">
          <div class="item-def">Password</div>
          <input type="password" name="passwd">
          <br>
          <div class="item-def">Confirm Password</div>
          <input type="password" name="cf_passwd">
          <br>
          <input type="submit" name="button" value="Change password" class="btn-def">
        </form>
      </div>
    </div>
    <div class="global-cell-1">
      <div class="title-def cell-1">Change Settings</div>
      <div class="cell-2">
        <form method="POST">
          <div class="item-def">Password</div>
          <input type="password" name="passwd">
          <br>
          <div class="item-def">Confirm Password</div>
          <input type="password" name="cf_passwd">
          <br>
          <input type="submit" name="button" value="Change password" class="btn-def">
        </form>
      </div>
    </div>  
  </div>
</div>

</div>
<script type="text/javascript" src="js/test.js"></script> 







