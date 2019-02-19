var crownLayer = document.getElementById('CrownLayer'),
	mustacheLayer = document.getElementById('MustacheLayer'),
	raybanLayer = document.getElementById('RaybanLayer'),
	sunglassesLayer = document.getElementById('SunglassesLayer'),
	trollLayer = document.getElementById('TrollLayer'),
	photo = document.getElementById('photo'),

	crownIcon = document.getElementById('Crown'),
	mustacheIcon = document.getElementById('Mustache'),
	raybanIcon = document.getElementById('Rayban'),
	sunglassesIcon = document.getElementById('Sunglasses'),
	trollIcon = document.getElementById('Troll'),
	greyScaleIcon = document.getElementById('GreyScale'),

	noneIcon = document.getElementById('None');

function showNone() {
	crownLayer.style.display = 'none';
	mustacheLayer.style.display = 'none';
	raybanLayer.style.display = 'none';
	sunglassesLayer.style.display = 'none';
	trollLayer.style.display = 'none';
	photo.style.filter = 'grayscale(0%)';

	crownIcon.checked = false;
	mustacheIcon.checked = false;
	raybanIcon.checked = false;
	sunglassesIcon.checked = false;
	trollIcon.checked = false;
	greyScaleIcon.checked = false;
}

function showCrown() {
	crownLayer.style.display = 'block';
	mustacheLayer.style.display = 'none';
	raybanLayer.style.display = 'none';
	sunglassesLayer.style.display = 'none';
	trollLayer.style.display = 'none';
	photo.style.filter = 'grayscale(0%)';

	noneIcon.checked = false;
}

function showMustache() {
	crownLayer.style.display = 'none';
	mustacheLayer.style.display = 'block';
	raybanLayer.style.display = 'none';
	sunglassesLayer.style.display = 'none';
	trollLayer.style.display = 'none';
	photo.style.filter = 'grayscale(0%)';

	noneIcon.checked = false;
}

function showRayban() {
	crownLayer.style.display = 'none';
	mustacheLayer.style.display = 'none';
	raybanLayer.style.display = 'block';
	sunglassesLayer.style.display = 'none';
	trollLayer.style.display = 'none';
	photo.style.filter = 'grayscale(0%)';

	noneIcon.checked = false;
}

function showSunglasses() {
	crownLayer.style.display = 'none';
	mustacheLayer.style.display = 'none';
	raybanLayer.style.display = 'none';
	sunglassesLayer.style.display = 'block';
	trollLayer.style.display = 'none';
	photo.style.filter = 'grayscale(0%)';

	noneIcon.checked = false;
}

function showTroll() {
	crownLayer.style.display = 'none';
	mustacheLayer.style.display = 'none';
	raybanLayer.style.display = 'none';
	sunglassesLayer.style.display = 'none';
	trollLayer.style.display = 'block';
	photo.style.filter = 'grayscale(0%)';

	noneIcon.checked = false;
}

function showGreyScale() {
	crownLayer.style.display = 'none';
	mustacheLayer.style.display = 'none';
	raybanLayer.style.display = 'none';
	sunglassesLayer.style.display = 'none';
	trollLayer.style.display = 'none';
	photo.style.filter = 'grayscale(100%)';

	noneIcon.checked = false;
}