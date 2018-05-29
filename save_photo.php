<?php

	// session_start();
	include_once 'inc/security.php';
	
	header("Content-Type: text/plain");
	$data = (isset($_POST["data"])) ? htmlspecialchars($_POST["data"]) : NULL;

    function insertIntoDatabase($p)
	{
	    include_once "config/database.php";
	    include_once "config/setup.php";
	    if ($bdd)
	    {
	    	echo "yoloo";
	    }
	    // try {
	    	echo $p;
	    	$id = $_SESSION['id'];
	    	echo $id;
	        $a = $bdd->prepare("INSERT INTO imgs (id, date_creation, post_url) VALUES (:id, NOW(), :p)");
	        $a->bindParam(':id', $id);
	        $a->bindParam(':p', $p);
	        $a->execute();
	    // }

	    // catch(PDOException $e) {
	    //     echo "Impossible to insert inside table post. The mistake is: ".$e;
	    // }
	}

	function savephoto($pt, $tab)
	{
				// $tab = json_decode($tab);

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

	}

	savephoto($_POST["data"], $_POST['tab']);

	function createmontage()
	{
		$data = explode(',', $_POST['data']);
    	$ext = strpos($data[0], "image");

	    if ($ext !== false) {

	        $img = $data[1];
	        $img = str_replace(' ', '+', $img);
	        $data = base64_decode($img);

	        file_put_contents("imgtest/test.png", $data);

	        $dest = imagecreatefrompng("imgtest/test.png");
	        $src = imagecreatefrompng("Content/abblack.png");

	        $srcs = imagecreatefrompng("Images/icone_power_off.png");
	        $res = imagecopyresized($dest, $srcs, 100, 150, 0, 0, 100, 100, 30, 30);
	        $res = imagecopyresized($dest, $srcs, 10, 150, 0, 0, 100, 100, 30, 30);

	        imagepng($dest, "imgtest/test2.png");
	    }		
	}
?>