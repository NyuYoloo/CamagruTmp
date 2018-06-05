<?php

	session_start();

	include_once 'config/setup.php';
	include_once 'inc/header.php';

?>


<!-- Presentation du site -->

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
	</div>
</body>
</html>
