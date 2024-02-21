document.addEventListener("DOMContentLoaded", function() {
	const carousel = document.querySelector(".carousel");
	const prevBtn = document.getElementById("prevBtn");
	const nextBtn = document.getElementById("nextBtn");

	if (!carousel || !prevBtn || !nextBtn) {
		return;
	}

	const carouselItems = document.querySelectorAll(".carousel-item");
	const totalItems = carouselItems.length;
	const itemWidth = carouselItems[0].clientWidth;
	let currentIndex = 0;

	carousel.style.width = totalItems * itemWidth + "px";

	function goToIndex(index) {
		if (index < 0 || index >= totalItems) return;
		currentIndex = index;
		const offset = -currentIndex * itemWidth;
		carousel.style.transform = `translateX(${offset}px)`;
	}

	prevBtn.addEventListener("click", function() {
		goToIndex(currentIndex - 1);
	});

	nextBtn.addEventListener("click", function() {
		goToIndex(currentIndex + 1);
	});
});
