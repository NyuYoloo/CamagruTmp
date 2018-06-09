<?php 
	
	function print_image()
	{
		include_once 'config/database.php';
		include_once 'config/setup.php';




		$log1 = $_SESSION['id'];

		$sql = $bdd->prepare("SELECT post_url, id_post, id FROM imgs WHERE id= :id");
		$sql->bindParam(':id', $log1);
		$sql->execute();

		$test = $sql->fetchAll();
		if (isset($_POST['submit']) == "Delete Img") {
			
			$req = $bdd->prepare("DELETE FROM imgs WHERE id_post = :id");
			$req->bindParam(":id", $test[0]['id_post']);
			$req->execute();	
		}
		
		foreach ($test as $key => $value) {
		?>
			<div style="border: 2px solid black; display: flex; flex-direction: column; max-width: 100%; margin: 7px; background-color: white">
				<img src="<?php echo $value['post_url'] ?>" style="max-width: 100%;">
				<div class="test1" style="display: flex; flex-direction: row;">
					<div class="likeContent" id="<?php echo $value['id_post']?>">
						<img style="width: 30px; border: none;" src="img/like.png">
						<span id="span<?php echo $value['id_post']?>" style="width: auto; heigth: auto; font-size: 20px">
						<?php 
							$imgid = $value['id_post'];
							$res = $bdd->query("SELECT * FROM likes WHERE img_id = '".$imgid."';");
							$res = count($res->fetchAll());
							echo $res;
						?>
						</span>
					</div>
					<div class="ComContent">
						<img style="width: 30px; border: none;" src="img/chat.png">
						<div style="width: auto; heigth: auto; font-size: 20px"></div>

					</div>
					<div class="logContent">
						<?php
							$id = $value['id'];
							$yo = $bdd->query("SELECT login FROM users WHERE id = '".$id."';");
							$yoloo = $yo->fetchAll();
						?>
						<a href="picture.php?id=<?php echo $value['id_post'] ?>"><?php echo $yoloo[0]['login']; ?></a>
					</div>
					<div class="DelContent">
						<form method="POST">
							<input type="submit" name="submit" value="Delete Img" class="btn-def"></input>
						<form>
					</div>
				</div>							
			</div>
			<?php
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
		?>
			<div style="border: 2px solid black; display: flex; flex-direction: column; max-width: 100%; margin: 7px; background-color: white">
				<img src="<?php echo $value['post_url'] ?>" style="max-width: 100%;">
				<div class="test1" style="display: flex; flex-direction: row;">
					<div class="likeContent" id="<?php echo $value['id_post']?>">
						<img style="width: 30px; border: none;" src="img/like.png">
						<span id="span<?php echo $value['id_post']?>" style="width: auto; heigth: auto; font-size: 20px">
						<?php 
							$imgid = $value['id_post'];
							$res = $bdd->query("SELECT * FROM likes WHERE img_id = '".$imgid."';");
							$res = count($res->fetchAll());
							echo $res;
						?>
						</span>
					</div>
					<div class="ComContent">
						<img style="width: 30px; border: none;" src="img/chat.png">
						<div style="width: auto; heigth: auto; font-size: 20px"></div>
					</div>
					<div class="logContent">
						<?php
							$id = $value['id'];
							$yo = $bdd->query("SELECT login FROM users WHERE id = '".$id."';");
							$yoloo = $yo->fetchAll();
						?>
						<a href="picture.php?id=<?php echo $value['id_post'] ?>"><?php echo $yoloo[0]['login']; ?></a>
					</div>
				</div>							
			</div>
			<?php
		}
	}
?>
