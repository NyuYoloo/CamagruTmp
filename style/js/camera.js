function  getDataURL() {
  var dataURL = canvas.toDataURL();
}

var streaming = false,
          video        = document.querySelector('#video'),
          cover        = document.querySelector('#cover'),
          canvas       = document.querySelector('#canvas'),
          photo        = document.querySelector('#photo'),
          startbutton  = document.querySelector('#startbutton'),
          width = 640,
          height = 480;

          var constraints = {
            audio: false,
            video: true
        };

navigator.mediaDevices.getUserMedia(constraints)
  .then(function (mediaStream) {
        // var video = document.querySelector('video');
        video.srcObject = mediaStream;
        video.onloadedmetadata = function (e) {
            video.play();
    };
  })
  .catch(function (err) {
    console.log(err.name + ": " + err.message);
});

      function takepicture() {

          canvas.width = width;
          canvas.height = height;

          canvas.getContext('2d').drawImage(video, 0, 0, width, height);
          data = canvas.toDataURL('image/png');

          var myImg = new Image();
          myImg.addEventListener('load', function() {
            canvas.getContext('2d').drawImage(myImg, 0, 0, 200, 100);
            dataR = canvas.toDataURL('image/png');

          }, false);
          let filtre = document.querySelectorAll("#mask img");
          let filtreDiv = document.querySelectorAll("#mask div");
          let tab = {};
          for (let i = 0; i < filtre.length; i++){
            tab[filtre[i].src] = filtreDiv[i].style.display == "none" ? 0 : 1;
          }
          tab = JSON.stringify(tab);
          var xhr = new XMLHttpRequest();
          xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
            {
                            // alert('Result ' + xhr.responseText);
                            console.log(xhr.responseText)
            }
        }
        xhr.open("POST", "save_photo.php", false);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        test = xhr.send('data='+ canvas.toDataURL('image/png') + "&tab=" + tab);
        console.log(test);
      };
        // var pv = document.getElementById('pic_view');

        // // /*Creation of the contour of the image*/
        // var newCadrage = document.createElement('div');
        // newCadrage.className = 'cadrage';
        // newCadrage.id = xhr.responseText;
        // pv.insertBefore(newCadrage, pv.firstChild);

        // // /*Creation of image captured by the cam*/
        // var newImg = document.createElement('img');
        // newImg.className = 'moovable_image';
        // newImg.src  = xhr.responseText;
        // newImg.title = xhr.responseText;


        // /*Creation of the contour of the image deleting*/
        // var newDelete = document.createElement('div');
        // newDelete.className = 'delete';
        // newDelete.id = 'delete';

        // /*Creation of image X (cross)*/
        // var ImgDel = document.createElement('img');
        // ImgDel.id= "cross";
        // ImgDel.src  = 'img/x2.png';

        // // /*Creation of the link on the cross*/
        // var newLink = document.createElement('a');
        // newLink.id = 'delpost_link';
        // newLink.href = 'script/delete_post.php?post_url='+ xhr.responseText + '&b=1';
        // newLink.title = xhr.responseText;

        // newCadrage.appendChild(newImg);
        // newCadrage.appendChild(newDelete);
        // newDelete.appendChild(newLink);
        // newLink.appendChild(ImgDel);
        // };


      startbutton.addEventListener('click', function(ev){
          takepicture();
        ev.preventDefault();
        getDataURL();
      }, false);

      // function upload(){
      //   var xhr = new XMLHttpRequest();
      //   xhr.onreadystatechange = function() {
      //   if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
      //       alert(xhr.responseText);
      //   }
      // }
      // xhr.open("POST", "upload.php", false);
      // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      // xhr.send('data='+ canvas.toDataURL('image/png'));
      // }

// window.onload = function() {
//     let allMask = document.querySelectorAll(".inputMask");
//     for (let i = 0; i < allMask.length; i++) {
//         allMask[i].addEventListener("click", function() {place(allMask[i].name)});
//     }
// }

// function place(chemin) {
//     let container = document.querySelector("#mask");
//     container.innerHTML += "<img src='" + chemin + "' style='position: absolute; left:0%; top:0%; width: 50px;' id='img' />";
// }


function toggle_div(id) {
  let setMaskId = document.getElementById(id)
  if (setMaskId) {
    setMaskId.style.display = "block";
  }
}

function del_div(id) {
  let delMaskId = document.getElementById(id)
  if (delMaskId) {
    delMaskId.style.display = "none";
  }
}

function montage() {

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
        alert(xhr.responseText);
    }
  }
  xhr.open("POST", "script/save_photo.php", false);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send('data='+ canvas.toDataURL('image/png'));
}
