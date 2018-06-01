<?php

?>

<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style/header.css">
</head>

<body>
	<div class="global-content">
		<div class="menu-content">
			<div><a href="index.php"><img class="menu-items menu-img" src="img/test.png"></a></div>
			<?php if (($_SESSION['login'])) { ?>
			<div class="menu-items menu-connexion separator-sides"><a style="color: white; text-decoration: none; display: none;" href="connexion.php">Sign in</a></div>
			<div class="menu-items menu-connexion separator-sides"><a style="color: white; text-decoration: none; display: none;" href="inscription.php">Sign up</a></div>
			<?php } 
			else { ?>
			<div class="menu-items menu-connexion separator-sides"><a style="color: white; text-decoration: none;" href="connexion.php">Sign in</a></div>
			<div class="menu-items menu-connexion separator-sides"><a style="color: white; text-decoration: none;" href="inscription.php">Sign up</a></div>
			<?php } ?>
		</div>
