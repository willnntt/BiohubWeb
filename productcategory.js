const container = document.getElementById("categoryWrapper");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");

function scrollCategoriesLeft() {
    container.scrollBy({ left: -200, behavior: "smooth" });
}

function scrollRight() {
    container.scrollBy({ left: 200, behavior: "smooth" });
}

