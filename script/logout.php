<?php

	session_start();
	$_SESSION['login'] = null;
	header('Location: ../index.php');

?>