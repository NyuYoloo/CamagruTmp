<?php
set_include_path("../");
include "config/database.php";
try {
	$bdd = new PDO($DB_DSN . ";dbname=camagru", $DB_USER, $DB_PASSWORD);
}
catch (Exception $e) {
	try {
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	}
	catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
	$req = file_get_contents("camagru.sql");
	$bdd->prepare($req)->execute();
}


// $bdd = new PDO('mysql:dbname=camagru;host=localhost', 'root', 'XPBz6akT');
// $bdd->setAtribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $bdd->setAtribute(PDO::ATTR_DEFAUT_FETCH_MODE, PDO::FETCH_OBJ);