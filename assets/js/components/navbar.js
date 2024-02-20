document.addEventListener('DOMContentLoaded', function () {
	const burger = document.querySelector('.burger');
	const menu = document.querySelector('.menu');

	burger.addEventListener('click', function () {
		if (menu.classList.contains('active')) {
			menu.classList.remove('active');
		} else {
			menu.classList.add('active');
		}
	});
});
