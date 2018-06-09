<?php
set_include_path("../");
include "config/database.php";

try {
	$bdd = new PDO($DB_DSN . ";dbname=camagru", $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (PDOException $e) {
	try {
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch (PDOException $e) {
		die('Erreur : ' . $e->getMessage());
	}
	$req = file_get_contents("camagru.sql");
	$bdd->prepare($req)->execute();
}

?>
