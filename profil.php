<?php

	include_once 'inc/security.php';
	include_once 'inc/header.php';
	include_once 'script/display_image.php'

?>

	<link rel="stylesheet" type="text/css" href="style/style.css">
 	<link rel="stylesheet" type="text/css" href="style/profil.css">
 <link rel="stylesheet" type="text/css" href="style/gallery.css">


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
		<div class="center-content" style="flex-direction: column;">
      		<div id="all-gal" class="display_img">
				<?php print_image(); ?>
			</div>	
		</div>
	</div>
<script type="text/javascript" src="js/like.js"></script>