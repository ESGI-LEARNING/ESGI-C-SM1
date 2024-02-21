document.addEventListener("DOMContentLoaded", function() {
    const carousel = document.querySelector(".carousel");
    const carouselItems = document.querySelectorAll(".carousel-item");
    const totalItems = carouselItems.length;
    const itemWidth = carouselItems[0].clientWidth;
    let currentIndex = 0;

    // Set width of carousel to fit all items
    carousel.style.width = totalItems * itemWidth + "px";

    function goToIndex(index) {
        if (index < 0 || index >= totalItems) return;
        currentIndex = index;
        const offset = -currentIndex * itemWidth;
        carousel.style.transform = `translateX(${offset}px)`;
    }

    // Previous button click event
    document.getElementById("prevBtn").addEventListener("click", function() {
        goToIndex(currentIndex - 1);
    });

    // Next button click event
    document.getElementById("nextBtn").addEventListener("click", function() {
        goToIndex(currentIndex + 1);
    });
});