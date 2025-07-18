document.addEventListener("DOMContentLoaded", function () {
    const carousel = document.querySelector(".carousel");
    if (!carousel) return;

    const arrowBtns = document.querySelectorAll("[id='left'], [id='right']");
    const wrapper = document.querySelector(".wrapper");

    const firstCard = carousel.querySelector(".card");
    const firstCardWidth = firstCard ? firstCard.offsetWidth : 250;

    let isDragging = false,
        startX,
        startScrollLeft,
        timeoutId;

    const dragStart = (e) => { 
        isDragging = true;
        carousel.classList.add("dragging");
        startX = e.pageX;
        startScrollLeft = carousel.scrollLeft;
    };

    const dragging = (e) => {
        if (!isDragging) return;
        carousel.scrollLeft = startScrollLeft - (e.pageX - startX);
    };

    const dragStop = () => {
        isDragging = false;
        carousel.classList.remove("dragging");
    };

    const autoPlay = () => {
        if (window.innerWidth < 800) return;

        const maxScrollLeft = carousel.scrollWidth - carousel.offsetWidth;
        if (carousel.scrollLeft >= maxScrollLeft) {
            carousel.scrollLeft = 0;  // Loop back to start
        } else {
            carousel.scrollLeft += firstCardWidth;
        }

        timeoutId = setTimeout(autoPlay, 3000);
    };

    // Start autoplay after 3s
    setTimeout(autoPlay, 3000);

    // Stop autoplay when user hovers
    wrapper.addEventListener("mouseenter", () => clearTimeout(timeoutId));
    wrapper.addEventListener("mouseleave", autoPlay);

    // Fix button click event
    arrowBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            console.log("Button clicked:", btn.id);
            carousel.scrollLeft += btn.id === "left" ? -firstCardWidth : firstCardWidth;
        });
    });

    // Drag event listeners
    carousel.addEventListener("mousedown", dragStart);
    carousel.addEventListener("mousemove", dragging);
    document.addEventListener("mouseup", dragStop);
});