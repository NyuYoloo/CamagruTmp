<?php

	include_once 'inc/security.php';
	
	header("Content-Type: text/plain");
	// $data = (isset($_POST["data"])) ? htmlspecialchars($_POST["data"]) : NULL;

	if (isset($_POST['data']) && isset($_POST['tab'])) {
		savephoto(htmlspecialchars($_POST["data"]), $_POST["tab"]);
	}

	function insertIntoDatabase($p)
	{
		include_once "config/database.php";
		include_once "config/setup.php";

			$id = $_SESSION['id'];
			$a = $bdd->prepare("INSERT INTO imgs (id, date_creation, post_url) VALUES (:id, NOW(), :p)");
			$a->bindParam(':id', $id);
			$a->bindParam(':p', $p);
			$a->execute();
	}

	function savephoto($pt, $tab)
	{
				$tab = json_decode($tab);
				// print_r($tab);
				$pt = str_replace('data:image/png;base64,', '', $pt);
				$pt = str_replace(' ','+', $pt);
				$pt = base64_decode($pt);
				$uiid = uniqid();
				if (!file_exists('photos')) {
					mkdir('photos');
				}

				// foreach ($tab as $key => $value) {
				// 	echo $key."&&&&".$value;
				// 	if ($value == 1)
				// 	{
				// 		createmontage();
				// 	}
				// }
				// $photo_cam = imagecreatefromstring($pt);
				// if ($fil !== 'none')
				//     createmontage($photo_cam, $fil);
				// else
				// {
					$p = 'photos/'. $uiid . '.png';
					insertIntoDatabase($p);
					// echo $p;
					file_put_contents($p, $pt);
					$i = 0;
				foreach ($tab as $key => $value) {
					if ($value === 1) {
						createmontage($key, $p, $i);
					}
					$i++;
				}

	}


	function createmontage($img, $dst, $i)
	{
		$pic = imagecreatefrompng($dst);
		$img = explode('/', $img);
		foreach ($img as $key2 => $value2) {
			$nname = $value2;
		}
		list($wori, $hori) = getimagesize("img/png/".$nname);
		$src = imagecreatefrompng("img/png/" . $nname);
		if ($i === 0)
			imagecopyresized($pic, $src, 320, 170, 0, 0, 100, 100, $wori, $hori);
		if ($i === 1)
			imagecopyresized($pic, $src, 30, 170, 0, 0, 100, 100, $wori, $hori);
		if ($i === 2)
			imagecopyresized($pic, $src, 120, 170, 0, 0, 100, 100, $wori, $hori);
		if ($i === 3)
			imagecopyresized($pic, $src, 0, 10, 0, 0, 100, 100, $wori, $hori);
		imagepng($pic, $dst, 0);
	}
?>