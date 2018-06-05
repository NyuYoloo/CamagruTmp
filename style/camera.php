<?php

  include_once 'inc/security.php';
	include_once 'inc/header.php';
  include_once 'config/database.php';
  include_once 'config/setup.php';

?>

<link rel="stylesheet" type="text/css" href="style/camera.css">
<link rel="stylesheet" type="text/css" href="style/style.css">

<div class="main-content">
  <div class="menu-left" style="text-align: center;">
    <div>
      <div><a href="gallery.php"><img class="menu-icons separator" src="img/compass.png"></a></div>
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
    <div class="snap-content">
      <div style="background-color: black; width: 150px; height: 100%">
        <div class="collage-content">
          <div>
            <div><img class="collage-item" src="img/png/1.png"></div>
            <div><button onclick="toggle_div('image-1')">Set</button></div>
            <div><button onclick="del_div('image-1')">Delete</button></div>
          </div>
          <div>
            <div><img class="collage-item" src="img/png/2.png"></div>
            <div><button onclick="toggle_div('image-2')">Set</button></div>
            <div><button onclick="del_div('image-2')">Delete</button></div>
          </div>
          <div>
            <div><img class="collage-item" src="img/png/3.png"></div>
            <div><button onclick="toggle_div('image-3')">Set</button></div>
            <div><button onclick="del_div('image-3')">Delete</button></div>
          </div>
          <div>
            <div><img class="collage-item" src="img/png/4.png"></div>
            <div><button onclick="toggle_div('image-4')">Set</button></div>
            <div><button onclick="del_div('image-4')">Delete</button></div>
          </div>
        </div>
      </div>
      <div style="background-color: red; width: 640px; height: 480px; position: relative">
        <video id="video"></video>
        <div id="mask" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%">
          <div id="image-1" style="display: none" class="masks" ><img src="img/png/1.png" style="position: absolute; top: 170px; left: 320px; width: 100px;"></div>
          <div id="image-2" style="display: none" class="masks" ><img src="img/png/2.png" style="position: absolute; top: 170px; left: 30px; width: 100px;"></div>
          <div id="image-3" style="display: none" class="masks" ><img src="img/png/3.png" style="position: absolute; top: 170px; left: 120px; width: 100px;"></div>
          <div id="image-4" style="display: none" class="masks" ><img src="img/png/4.png" style="position: absolute; top: 10px; left: 0px; width: 100px;"></div>
        </div>
        <canvas id="canvas" style="display: none;"></canvas>
        <button id="startbutton">Take a Picture</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/camera.js"></script>
