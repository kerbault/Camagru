function preview_image(event) {

	var output = document.getElementById('photo'),

		FileSize = event.target.files[0].size / 1024 / 1024; // in MB
	if (FileSize > 2) {
		alert('File size exceeds 2 MB');
		document.getElementById('fileToUpload').value = ''
		output.setAttribute('src', 'public/images/you_photo_here.png');
	} else {
		if (event.target.files && event.target.files[0]) {
			var reader = new FileReader();
			reader.onload = function () {
				output.src = reader.result;
			}
			reader.readAsDataURL(event.target.files[0]);
		} else {
			output.setAttribute('src', 'public/images/you_photo_here.png');
		}
	}
}

function rejectLayer() {
	if (document.getElementById('None').checked) {
		alert("You have to select a filter");
	}
}
