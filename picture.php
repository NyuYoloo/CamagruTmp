<?php 
	
	include_once 'inc/security.php';
	include_once 'inc/header.php';
	include_once 'config/database.php';
	include_once 'config/setup.php';

	$id = $_GET['id'];

	$res = $bdd->prepare("SELECT post_url FROM imgs WHERE (id_post = :id_post)");
	$res->bindParam(":id_post", $id);
	$res->execute();
	$img = $res->fetchAll();


	$sql = $bdd->prepare("SELECT * FROM imgs");
	$sql->execute();
	$test = $sql->fetchAll();

?>

<link rel="stylesheet" type="text/css" href="style/style.css">

<div class="main-content">
    <div class="menu-left" style="text-align: center;">
      <div><div><a href="gallery.php"><img class="menu-icons separator" src="img/compass.png"></a></div>
      <?php if (isset($_SESSION['login'])) { ?>
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
    	<div class="display_img" style="font-size: 10px">
	    	<div style="border: 2px solid black; display: flex; flex-direction: column; max-width: 100%; margin: 7px; background-color: white">
					<img src="<?php echo $img[0]['post_url'] ?>" style="max-width: 100%;">
					<div class="test1" style="display: flex; flex-direction: row;">
						<div class="likeContent" id="<?php echo $test[0]['id_post']?>">
							<img style="width: 30px; border: none;" src="img/like.png">
							<span id="span<?php echo $test[0]['id_post']?>" style="width: auto; heigth: auto; font-size: 20px">
							<?php 
								$imgid = $test[0]['id_post'];
								$res = $bdd->query("SELECT * FROM likes WHERE img_id = '".$imgid."';");
								$res = count($res->fetchAll());
								echo $res;
							?>
						</div>
						<div class="ComContent">
							<img style="width: 30px; border: none;" src="img/chat.png">
							<div style="width: auto; height: auto; font-size: 20px"></div>
						</div>
						<div class="logContent">
						<?php
							$id = $test[0]['id'];
							$yo = $bdd->query("SELECT login FROM users WHERE id = '".$id."';");
							$yoloo = $yo->fetchAll();
							echo $yoloo[0]['login'];
						?>
						</div>
					</div>							
				</div>
	    	</div>
    </div>
	<script type="text/javascript" src="js/like.js"></script>
</div>
