// var definition

var width = 600,
	height = 450,
	canvas = document.getElementById('canvas'),
	photo = document.getElementById('photo'),
	video = document.getElementById('video'),
	buttonPhoto = document.getElementById('snap'),
	layer = 'none';

// running the camera

if (navigator.mediaDevices.getUserMedia) {
	navigator.mediaDevices.getUserMedia({video: true})
			 .then(function (stream) {
				 video.srcObject = stream;
				 video.onplay = function () {
					 buttonPhoto.style.display = 'block';
				 };
			 })
			 .catch(function (error) {
				 console.log(error);
			 });
}

function takePicture() {
	canvas.width = width;
	canvas.height = height;
	canvas.getContext('2d').drawImage(video, 0, 0, width, height);
	var data = canvas.toDataURL('image/png');
	photo.setAttribute('src', data);
}

// upload the capture

function sendMontage() {
	if (document.getElementById('None').checked) {
		alert("You have to select a filter");
	} else {
		canvas.width = width;
		canvas.height = height;
		canvas.getContext('2d').drawImage(photo, 0, 0, width, height);

		var data = canvas.toDataURL('image/png');

		if (document.getElementById('Crown').checked) {
			layer = 'Crown'
		} else if (document.getElementById('Mustache').checked) {
			layer = 'Mustache'
		} else if (document.getElementById('Rayban').checked) {
			layer = 'Rayban'
		} else if (document.getElementById('Sunglasses').checked) {
			layer = 'Sunglasses'
		} else if (document.getElementById('Troll').checked) {
			layer = 'Troll'
		} else if (document.getElementById('GreyScale').checked) {
			layer = 'GreyScale'
		}

		var xhr = new XMLHttpRequest();

		xhr.open("POST", 'http://localhost:8008/index.php?action=uploadThat', true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("&data=" + data + "&layer=" + layer);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText != "") {
				location.reload();
			}
		};
	}
}


