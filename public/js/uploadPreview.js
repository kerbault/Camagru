function preview_image(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('photo');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}