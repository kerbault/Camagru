function showNone() {
    document.getElementById('CrownLayer').style.display = 'none';
    document.getElementById('MustacheLayer').style.display = 'none';
    document.getElementById('RaybanLayer').style.display = 'none';
    document.getElementById('SunglassesLayer').style.display = 'none';
    document.getElementById('TrollLayer').style.display = 'none';
    document.getElementById('photo').style.filter = 'grayscale(0%)';

    document.getElementById('Crown').checked = false;
    document.getElementById('Mustache').checked = false;
    document.getElementById('Rayban').checked = false;
    document.getElementById('Sunglasses').checked = false;
    document.getElementById('Troll').checked = false;
}

function showCrown() {
    document.getElementById('CrownLayer').style.display = 'block';
    document.getElementById('MustacheLayer').style.display = 'none';
    document.getElementById('RaybanLayer').style.display = 'none';
    document.getElementById('SunglassesLayer').style.display = 'none';
    document.getElementById('TrollLayer').style.display = 'none';
    document.getElementById('photo').style.filter = 'grayscale(0%)';

    document.getElementById('None').checked = false;

}

function showMustache() {
    document.getElementById('CrownLayer').style.display = 'none';
    document.getElementById('MustacheLayer').style.display = 'block';
    document.getElementById('RaybanLayer').style.display = 'none';
    document.getElementById('SunglassesLayer').style.display = 'none';
    document.getElementById('TrollLayer').style.display = 'none';
    document.getElementById('photo').style.filter = 'grayscale(0%)';

    document.getElementById('None').checked = false;

}

function showRayban() {
    document.getElementById('CrownLayer').style.display = 'none';
    document.getElementById('MustacheLayer').style.display = 'none';
    document.getElementById('RaybanLayer').style.display = 'block';
    document.getElementById('SunglassesLayer').style.display = 'none';
    document.getElementById('TrollLayer').style.display = 'none';
    document.getElementById('photo').style.filter = 'grayscale(0%)';

    document.getElementById('None').checked = false;

}

function showSunglasses() {
    document.getElementById('CrownLayer').style.display = 'none';
    document.getElementById('MustacheLayer').style.display = 'none';
    document.getElementById('RaybanLayer').style.display = 'none';
    document.getElementById('SunglassesLayer').style.display = 'block';
    document.getElementById('TrollLayer').style.display = 'none';
    document.getElementById('photo').style.filter = 'grayscale(0%)';

    document.getElementById('None').checked = false;

}

function showTroll() {
    document.getElementById('CrownLayer').style.display = 'none';
    document.getElementById('MustacheLayer').style.display = 'none';
    document.getElementById('RaybanLayer').style.display = 'none';
    document.getElementById('SunglassesLayer').style.display = 'none';
    document.getElementById('TrollLayer').style.display = 'block';
    document.getElementById('photo').style.filter = 'grayscale(0%)';


    document.getElementById('None').checked = false;

}

function showGreyScale() {
    document.getElementById('CrownLayer').style.display = 'none';
    document.getElementById('MustacheLayer').style.display = 'none';
    document.getElementById('RaybanLayer').style.display = 'none';
    document.getElementById('SunglassesLayer').style.display = 'none';
    document.getElementById('TrollLayer').style.display = 'none';
    document.getElementById('photo').style.filter = 'grayscale(100%)';

    document.getElementById('None').checked = false;
}