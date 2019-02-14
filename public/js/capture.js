// var definition

var width = 600;
var height = 450;
var canvas = document.getElementById('canvas');
var photo = document.getElementById('photo');
var video = document.getElementById('video');

// running the camera

if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({video: true})
        .then(function (stream) {
            video.srcObject = stream;
        })
        .catch(function (error) {
            console.log(error);
        });
}

// capture frame

function takePicture() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
}

// upload the capture

function sendMontage(data) {
    canvas.getContext('2d').drawImage(canvas, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');


    console.log(data); // CanvasRenderingContext2D { ... }
}