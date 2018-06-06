<?php 
	
	function print_image()
	{
		include_once 'config/database.php';
		include_once 'config/setup.php';

		$log1 = $_SESSION['id'];

		$sql = $bdd->prepare("SELECT post_url FROM imgs WHERE id= :id");
		$sql->bindParam(':id', $log1);
		$sql->execute();

		$test = $sql->fetchAll();
		foreach ($test as $key => $value) {
			echo "<img src='".$value['post_url']."'>";
		}
	}

	function print_image_gal()
	{
		include_once 'config/database.php';
		include_once 'config/setup.php';

		$sql = $bdd->prepare("SELECT * FROM imgs");
		$sql->execute();

		$test = $sql->fetchAll();
		foreach ($test as $key => $value) {
			print_r($value);
		 ?>
			<div style="border: 2px solid black; display: flex; flex-direction: column;">
				<img src="<?php echo $value['post_url'] ?>">
				<div class='likeContent' id="<?php echo $value['id_post']?>">
					<img style="width: 30px" src="img/like.png">
					<span id="span<?php echo $value['id_post']?>" style="width: auto; heigth: auto; font-size: 20px">
					<?php 
						$imgid = $value['id_post'];
						$res = $bdd->query("SELECT * FROM likes WHERE img_id = '".$imgid."';");
						$res = count($res->fetchAll());
						echo $res;
					?>
					</span>
				</div>		
			</div>
			<?php
  			// echo '<div class="num">'.$post['nb_likes'].'</div><img src="img/like.png">';
		}
	}
?>
