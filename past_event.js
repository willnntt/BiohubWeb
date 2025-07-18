document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.past-event-slider');
    const slides = document.querySelectorAll('.past-event-slide');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const paginationInfo = document.getElementById('paginationInfo');

    let currentSlide = 0;
    const totalSlides = slides.length;

    function updatePagination() {
        // Update page numbers (1-indexed)
        paginationInfo.textContent = `${currentSlide + 1} of ${totalSlides}`;
        
        // Disable/enable navigation buttons
        prevBtn.disabled = currentSlide === 0;
        nextBtn.disabled = currentSlide === totalSlides - 1;
    }

    function goToSlide(slideIndex) {
        slider.style.transform = `translateX(-${slideIndex * 100}%)`;
        currentSlide = slideIndex;
        updatePagination();
    }

    // Event Listeners for Navigation
    prevBtn.addEventListener('click', () => {
        if (currentSlide > 0) {
            goToSlide(currentSlide - 1);
        }
    });

    nextBtn.addEventListener('click', () => {
        if (currentSlide < totalSlides - 1) {
            goToSlide(currentSlide + 1);
        }
    });

    // Initial pagination setup
    updatePagination();
});