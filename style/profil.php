<?php
	
	include_once 'inc/security.php';
	include_once 'inc/header.php';

?>

	<link rel="stylesheet" type="text/css" href="style/style.css">
 	<link rel="stylesheet" type="text/css" href="style/profil.css">


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
				<div class="col-md-3">
					<div class="text-center">
						<div class="card">
							<center>
								<img class="avatar" src="<?php echo $image ?>">
							</center>
						 	<h1><?php echo $_SESSION['login']?> </h1>
						 	<p class="title">CEO & Founder, Example</p>
						 	<p>Harvard University</p>
						 	<p><button>Contact</button></p>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="image-card" style="margin: 10px;">
						<?php print_image(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>