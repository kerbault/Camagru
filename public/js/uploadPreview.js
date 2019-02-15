function preview_image(event) {

    var output = document.getElementById('photo');

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
