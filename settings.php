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

    if ($_GET['confirmed'] == "Delete Account")
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

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="style/css/bootstrap.min.css" rel="stylesheet">
  <link href="style/css/mdb.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style/connexion.css">
  <link rel="stylesheet" type="text/css" href="style/style.css">


<div class="main-content">
    <div class="menu-left" style="text-align: center;">
      <div><div><a href="gallery.php"><img class="menu-icons separator" src="img/compass.png"></a></div>
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
    <div class="center-content">
      <div class="row">
        <div class="col-md-9 personal-info">
          <?php if ($_GET['confirmed'] === "Delete Account") { ?>
            <div class="alert alert-info alert-dismissable">
              <a class="panel-close close" data-dismiss="alert">×</a> 
              <i class="fa fa-coffee"></i>
              <?php echo $ret ?>
            </div>
          <?php } ?>
          <h3>Delete Account</h3>  
          <form class="form-horizontal" role="form" method="GET">
            <div class="form-group">
              <label class="col-md-3 control-label">Your email:</label>
              <div class="col-md-8">
               <input class="form-control" type="email" name="confirm-email" value="">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Your password:</label>
              <div class="col-md-8">
                <input class="form-control" type="password" name="passwd" value="">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="submit" class="btn-def" name="confirmed" value="Delete Account">
              <span></span>
              <input type="reset" class="btn-def" value="Cancel">
            </div>
          </div>
          </form>
        </div>
      </div>
</div>
<script type="text/javascript" src="js/test.js"></script> 