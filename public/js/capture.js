// var video = document.getElementById("video");
// var canvas = document.getElementById("canvas");
// var imgUpload = document.getElementById("photo");
// var width = 650;
// var height = 600;
// var file = "";
// var videoFunciona = false;
// var data = null;
// var constraints = {audio: false, video: true};
// var image = new Image();
//
// imgUpload.onchange = function (event) {
//
//
//     canvas.style.display = "block";
//     canvas.width = 650;
//     canvas.height = 600;
//
//     if (this.files[0])
//         image.src = window.URL.createObjectURL(this.files[0]);
//
//     image.addEventListener("load", cargado);
//
//     function cargado(e) {
//         canvas.getContext('2d').drawImage(image, 0, 0, canvas.width, canvas.height);
//         data = canvas.toDataURL('image/png');
//         video.style.display = "none";
//
//         if (videoFunciona) {
//             let stream = video.srcObject;
//             let tracks = stream.getTracks();
//
//             tracks.forEach(function (track) {
//                 track.stop();
//             });
//
//             video.srcObject = null;
//         }
//         videoFunciona = false;
//
//     }
//
// }
//
// navigator.mediaDevices.getUserMedia(constraints).then(videoOk).catch(videoKo);
//
// function videoOk(mediaStream) {
//     video.srcObject = mediaStream;
//     videoFunciona = true;
//     video.onloadedmetadata = function (event) {
//         video.play();
//     };
//     document.getElementById('video').style.display = "block";
//     document.getElementById('canvas').style.display = "none";
// }
//
// function videoKo(error) {
//     console.log(error.name + ": " + error.message);
//     document.getElementById('imgUpload').style.display = "block";
//     document.getElementById('video').style.display = "none";
// }
//
// video.addEventListener('canplay', function (ev) {
//     height = video.videoHeight / (video.videoWidth / width);
// }, false);
//
// startbutton.addEventListener('click', function (ev) {
//     hacerfoto();
//     ev.preventDefault();
// }, false);
//
// function hacerfoto() {
//     canvas.width = width;
//     canvas.height = height;
//     if (videoFunciona) {
//         canvas.getContext('2d').drawImage(video, 0, 0, width, height);
//         data = canvas.toDataURL('image/png');
//     }
//
//     if (document.getElementById('gato').checked)
//         file = "gato.png";
//     else if (document.getElementById('bigote').checked)
//         file = "bigote.png";
//     else if (document.getElementById('caca').checked)
//         file = "caca.png";
//     else if (document.getElementById('marco').checked)
//         file = "marco.png";
//
//
//     var xhr = new XMLHttpRequest();
//
//     xhr.onreadystatechange = function () {
//         if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText != "") {
//             var respuesta = xhr.responseText.split(' ');
//
//             nuevaImg = document.createElement('img');
//             newDiv = document.createElement('div');
//             newDiv.style.width = "100%";
//
//             nuevaImg.src = respuesta[0];
//             newDiv.setAttribute("id", respuesta[1]);
//             nuevaImg.setAttribute("value", respuesta[1]);
//             nuevaImg.setAttribute("onclick", "deleteImg(this)");
//             newDiv.appendChild(nuevaImg);
//             minifotos = document.getElementById('minifotos');
//             minifotos.appendChild(newDiv);
//
//             if (canvas.getAttribute("style") == "display: block;")
//                 canvas.getContext('2d').drawImage(image, 0, 0, canvas.width, canvas.height);
//
//         }
//         ;
//     };
//     if (file && file != "" && data) {
//         xhr.open("POST", "config/fotos.php", true);
//         xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//         xhr.send("filtro=" + "../filtros/" + file + "&foto=" + data);
//     }
//
// }
//
// function mostrarbt() {
//     document.getElementById('captureButton').style.display = "block";
//     if (document.getElementById('gato').checked) {
//         document.getElementById('gatoV').style.display = "block";
//         document.getElementById('bigoteV').style.display = "none";
//         document.getElementById('cacaV').style.display = "none";
//         document.getElementById('marcoV').style.display = "none";
//     }
//     else if (document.getElementById('bigote').checked) {
//         document.getElementById('gatoV').style.display = "none";
//         document.getElementById('bigoteV').style.display = "block";
//         document.getElementById('cacaV').style.display = "none";
//         document.getElementById('marcoV').style.display = "none";
//     }
//     else if (document.getElementById('caca').checked) {
//         document.getElementById('gatoV').style.display = "none";
//         document.getElementById('bigoteV').style.display = "none";
//         document.getElementById('cacaV').style.display = "block";
//         document.getElementById('marcoV').style.display = "none";
//     }
//     else if (document.getElementById('marco').checked) {
//         document.getElementById('gatoV').style.display = "none";
//         document.getElementById('bigoteV').style.display = "none";
//         document.getElementById('cacaV').style.display = "none";
//         document.getElementById('marcoV').style.display = "block";
//     }
// }
//
// function deleteImg(img) {
//     var xhr = new XMLHttpRequest();
//
//     xhr.onreadystatechange = function () {
//         if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
//             var imagen = document.getElementById(img.getAttribute("value"));
//             imagen.remove();
//         }
//     }
//
//     xhr.open("POST", "index.php?action=deleteImg", true);
//     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//     xhr.send("id_img=" + img.getAttribute("value"));
// }
//


// function getUserMedia(options, successCallback, failureCallback) {
//     var api = navigator.getUserMedia || navigator.webkitGetUserMedia ||
//         navigator.mozGetUserMedia || navigator.msGetUserMedia;
//     if (api) {
//         return api.bind(navigator)(options, successCallback, failureCallback);
//     }
// }
//
// function getStream (type) {
//     if (!navigator.getUserMedia && !navigator.webkitGetUserMedia &&
//         !navigator.mozGetUserMedia && !navigator.msGetUserMedia) {
//         alert('User Media API not supported.');
//         return;
//     }
//
//     var constraints = {};
//     constraints[type] = true;
//     getUserMedia(constraints, function (stream) {
//         var mediaControl = document.querySelector(type);
//
//         if ('srcObject' in mediaControl) {
//             mediaControl.srcObject = stream;
//             mediaControl.src = (window.URL || window.webkitURL).createObjectURL(stream);
//         } else if (navigator.mozGetUserMedia) {
//             mediaControl.mozSrcObject = stream;
//         }
//     }, function (err) {
//         alert('Error: ' + err);
//     });
// }

// (function () {
//     // The width and height of the captured photo. We will set the
//     // width to the value defined here, but the height will be
//     // calculated based on the aspect ratio of the input stream.
//
//     var width = 600;    // We will scale the photo width to this
//     var height = 0;     // This will be computed based on the input stream
//
//     // |streaming| indicates whether or not we're currently streaming
//     // video from the camera. Obviously, we start at false.
//
//     var streaming = false;
//
//     // The various HTML elements we need to configure or control. These
//     // will be set by the startup() function.
//
//     var video = null;
//     var canvas = null;
//     var photo = null;
//     var startbutton = null;
//
//
//
//     function startup() {
//         video = document.getElementById('video');
//         canvas = document.getElementById('canvas');
//         photo = document.getElementById('photo');
//         startbutton = document.getElementById('startbutton');
//
//         navigator.getMedia = (navigator.getUserMedia ||
//             navigator.webkitGetUserMedia ||
//             navigator.mediaDevices.getUserMedia ||
//             navigator.msGetUserMedia);
//
//         navigator.getMedia(
//             {
//                 video: true,
//                 audio: false
//             },
//             function (stream) {
//                 video.srcObject = stream;
//                 video.play();
//             },
//             function (err) {
//                 console.log("An error occured! " + err);
//             }
//         );
//
//         video.addEventListener('canplay', function (ev) {
//             if (!streaming) {
//                 height = video.videoHeight / (video.videoWidth / width);
//
//                 // Firefox currently has a bug where the height can't be read from
//                 // the video, so we will make assumptions if this happens.
//
//                 if (isNaN(height)) {
//                     height = width / (4 / 3);
//                 }
//
//                 video.setAttribute('width', width);
//                 video.setAttribute('height', height);
//                 canvas.setAttribute('width', width);
//                 canvas.setAttribute('height', height);
//                 streaming = true;
//             }
//         }, false);
//
//         snap.addEventListener('click', function (ev) {
//             takepicture();
//             ev.preventDefault();
//         }, false);
//
//         clearphoto();
//     }
//
//     // Fill the photo with an indication that none has been
//     // captured.
//
//     function clearphoto() {
//         var context = canvas.getContext('2d');
//         context.fillStyle = "#AAA";
//         context.fillRect(0, 0, canvas.width, canvas.height);
//
//         var data = canvas.toDataURL('image/png');
//         photo.setAttribute('src', data);
//     }
//
//     // Capture a photo by fetching the current contents of the video
//     // and drawing it into a canvas, then converting that to a PNG
//     // format data URL. By drawing it on an offscreen canvas and then
//     // drawing that to the screen, we can change its size and/or apply
//     // other changes before drawing it.
//
//     function takepicture() {
//         var context = canvas.getContext('2d');
//         if (width && height) {
//             canvas.width = width;
//             canvas.height = height;
//             context.drawImage(video, 0, 0, width, height);
//
//             var data = canvas.toDataURL('image/png');
//             photo.setAttribute('src', data);
//         } else {
//             clearphoto();
//         }
//     }
//
//     // Set up our event listener to run the startup process
//     // once loading is complete.
//     window.addEventListener('load', startup, false);
// })();

var video = document.getElementById('video');

if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({video: true})
        .then(function (stream) {
            video.srcObject = stream;
        })
        .catch(function (error) {
            console.log(error);
        });
}